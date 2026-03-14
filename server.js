const http = require("http");
const fs = require("fs");
const path = require("path");

const PORT = Number(process.env.PORT) || 3000;
const HOST = process.env.HOST || "0.0.0.0";
const PUBLIC_DIR = path.join(__dirname, "public");

// Customize these values if you want more or less parallelism per run.
const CONCURRENCY_LIMIT = 25;
const REQUEST_TIMEOUT_MS = 12000;
const HTML_READ_LIMIT_BYTES = 512 * 1024;
const MAX_BODY_SIZE_BYTES = 1024 * 1024;

const DEFAULT_HEADERS = {
  "User-Agent": "LocalWordPressChecker/1.0 (+http://localhost:3000)",
  Accept: "text/html,application/xhtml+xml",
};

const MIME_TYPES = {
  ".css": "text/css; charset=UTF-8",
  ".html": "text/html; charset=UTF-8",
  ".js": "application/javascript; charset=UTF-8",
  ".json": "application/json; charset=UTF-8",
  ".svg": "image/svg+xml",
};

const WORDPRESS_SIGNATURES = [
  "wp-content/",
  "wp-includes/",
  "wp-json",
  "xmlrpc.php",
];

function sendJson(res, statusCode, payload) {
  res.writeHead(statusCode, {
    "Content-Type": "application/json; charset=UTF-8",
  });
  res.end(JSON.stringify(payload));
}

function normalizeUrl(rawUrl) {
  const trimmed = String(rawUrl || "").trim();

  if (!trimmed) {
    throw new Error("URL is empty");
  }

  const withProtocol = /^[a-zA-Z][a-zA-Z\d+\-.]*:/.test(trimmed)
    ? trimmed
    : `https://${trimmed}`;

  const parsed = new URL(withProtocol);

  if (parsed.protocol !== "http:" && parsed.protocol !== "https:") {
    throw new Error("Only http:// and https:// URLs are supported");
  }

  return parsed.toString();
}

function detectWordPress(html) {
  const lowerHtml = html.toLowerCase();

  if (WORDPRESS_SIGNATURES.some((signature) => lowerHtml.includes(signature))) {
    return true;
  }

  return /<meta[^>]+name=["']generator["'][^>]+content=["'][^"']*wordpress/i.test(html);
}

function getAttributeValue(tag, attributeName) {
  const pattern = new RegExp(`${attributeName}\\s*=\\s*("([^"]*)"|'([^']*)'|([^\\s>]+))`, "i");
  const match = tag.match(pattern);

  if (!match) {
    return "";
  }

  return (match[2] || match[3] || match[4] || "").trim();
}

function findMetaContent(html, attributeName, attributeValue) {
  const metaTags = html.match(/<meta\b[^>]*>/gi) || [];

  for (const tag of metaTags) {
    const actualValue = getAttributeValue(tag, attributeName).toLowerCase();

    if (actualValue === attributeValue) {
      const content = getAttributeValue(tag, "content");

      if (content) {
        return content;
      }
    }
  }

  return "";
}

function toAbsoluteUrl(candidate, baseUrl) {
  if (!candidate) {
    return null;
  }

  try {
    return new URL(candidate, baseUrl).toString();
  } catch (_error) {
    return null;
  }
}

function extractPreviewImage(html, pageUrl) {
  const ogImage = findMetaContent(html, "property", "og:image");

  if (ogImage) {
    return toAbsoluteUrl(ogImage, pageUrl);
  }

  const twitterImage = findMetaContent(html, "name", "twitter:image");

  if (twitterImage) {
    return toAbsoluteUrl(twitterImage, pageUrl);
  }

  const imageTags = html.match(/<img\b[^>]*>/gi) || [];

  for (const tag of imageTags) {
    const src = getAttributeValue(tag, "src");
    const absoluteSrc = toAbsoluteUrl(src, pageUrl);

    if (absoluteSrc) {
      return absoluteSrc;
    }
  }

  return null;
}

async function readResponseSample(response) {
  if (!response.body || typeof response.body.getReader !== "function") {
    return response.text();
  }

  const reader = response.body.getReader();
  const decoder = new TextDecoder();
  let html = "";
  let totalBytes = 0;

  try {
    while (true) {
      const { done, value } = await reader.read();

      if (done) {
        break;
      }

      totalBytes += value.byteLength;
      html += decoder.decode(value, { stream: true });

      if (totalBytes >= HTML_READ_LIMIT_BYTES) {
        break;
      }
    }

    html += decoder.decode();
    return html;
  } finally {
    reader.cancel().catch(() => { });
  }
}

async function checkUrl(rawUrl) {
  let url;

  try {
    url = normalizeUrl(rawUrl);
  } catch (error) {
    return {
      url: String(rawUrl || ""),
      status: "error",
      httpStatus: null,
      error: error.message,
      previewImage: null,
    };
  }

  const controller = new AbortController();
  const timeoutId = setTimeout(() => controller.abort(), REQUEST_TIMEOUT_MS);

  try {
    const response = await fetch(url, {
      headers: DEFAULT_HEADERS,
      redirect: "follow",
      signal: controller.signal,
    });

    if (!response.ok) {
      return {
        url,
        status: "error",
        httpStatus: response.status,
        error: `HTTP ${response.status}`,
        previewImage: null,
      };
    }

    const html = await readResponseSample(response);
    const previewImage = extractPreviewImage(html, url);

    return {
      url,
      status: detectWordPress(html) ? "wordpress" : "not_wordpress",
      httpStatus: response.status,
      error: null,
      previewImage,
    };
  } catch (error) {
    const message =
      error && error.name === "AbortError"
        ? `Request timed out after ${REQUEST_TIMEOUT_MS} ms`
        : error && error.message
          ? error.message
          : "Request failed";

    return {
      url,
      status: "error",
      httpStatus: null,
      error: message,
      previewImage: null,
    };
  } finally {
    clearTimeout(timeoutId);
  }
}

async function mapWithConcurrency(items, limit, mapper) {
  const results = new Array(items.length);
  let nextIndex = 0;

  async function worker() {
    while (true) {
      const currentIndex = nextIndex;
      nextIndex += 1;

      if (currentIndex >= items.length) {
        return;
      }

      results[currentIndex] = await mapper(items[currentIndex], currentIndex);
    }
  }

  const workerCount = Math.min(limit, items.length);
  await Promise.all(Array.from({ length: workerCount }, worker));
  return results;
}

function buildSummary(results) {
  return results.reduce(
    (summary, result) => {
      summary.total += 1;
      summary[result.status] += 1;
      return summary;
    },
    {
      total: 0,
      wordpress: 0,
      not_wordpress: 0,
      error: 0,
    },
  );
}

function readJsonBody(req) {
  return new Promise((resolve, reject) => {
    const chunks = [];
    let totalSize = 0;

    req.on("data", (chunk) => {
      totalSize += chunk.length;

      if (totalSize > MAX_BODY_SIZE_BYTES) {
        reject(new Error("Request body is too large"));
        req.destroy();
        return;
      }

      chunks.push(chunk);
    });

    req.on("end", () => {
      try {
        const rawBody = Buffer.concat(chunks).toString("utf8");
        resolve(rawBody ? JSON.parse(rawBody) : {});
      } catch (error) {
        reject(new Error("Invalid JSON body"));
      }
    });

    req.on("error", reject);
  });
}

async function handleCheckRequest(req, res) {
  try {
    const body = await readJsonBody(req);

    if (!body || !Array.isArray(body.urls)) {
      sendJson(res, 400, { error: "Expected JSON body: { urls: string[] }" });
      return;
    }

    const urls = body.urls
      .map((value) => String(value || "").trim())
      .filter(Boolean);

    const results = await mapWithConcurrency(urls, CONCURRENCY_LIMIT, checkUrl);
    const summary = buildSummary(results);

    sendJson(res, 200, { summary, results });
  } catch (error) {
    sendJson(res, 400, { error: error.message || "Unable to process request" });
  }
}

function safePublicPath(requestUrl) {
  const pathname = decodeURIComponent(new URL(requestUrl, "http://localhost").pathname);
  const requestedPath = pathname === "/" ? "/index.html" : pathname;
  const resolvedPath = path.resolve(PUBLIC_DIR, `.${requestedPath}`);

  if (!resolvedPath.startsWith(PUBLIC_DIR)) {
    return null;
  }

  return resolvedPath;
}

function serveStatic(req, res) {
  const filePath = safePublicPath(req.url);

  if (!filePath) {
    res.writeHead(403, { "Content-Type": "text/plain; charset=UTF-8" });
    res.end("Forbidden");
    return;
  }

  fs.readFile(filePath, (error, fileBuffer) => {
    if (error) {
      res.writeHead(404, { "Content-Type": "text/plain; charset=UTF-8" });
      res.end("Not found");
      return;
    }

    const contentType =
      MIME_TYPES[path.extname(filePath).toLowerCase()] || "application/octet-stream";

    res.writeHead(200, { "Content-Type": contentType });

    if (req.method === "HEAD") {
      res.end();
      return;
    }

    res.end(fileBuffer);
  });
}

const server = http.createServer((req, res) => {
  if (req.method === "POST" && req.url === "/check") {
    handleCheckRequest(req, res);
    return;
  }

  if (req.method === "GET" || req.method === "HEAD") {
    serveStatic(req, res);
    return;
  }

  res.writeHead(405, { "Content-Type": "text/plain; charset=UTF-8" });
  res.end("Method not allowed");
});

server.listen(PORT, HOST, () => {
  console.log(`WordPress checker running at http://${HOST}:${PORT}`);
});
