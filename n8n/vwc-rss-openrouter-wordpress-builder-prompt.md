Create an n8n workflow named `VWC RSS -> OpenRouter -> WordPress Auto Publish`.

Goal:
Monitor the VWC News website for newly published articles using its RSS feed, fetch each new article page, extract the exact original title, the main image, and the full article content, rewrite only the article body with OpenRouter using the `x-ai/grok-4.1-fast` model, then publish a new post to my WordPress site with:
- the exact original article title
- the original image as the featured image
- the rewritten article body as the post content
- a short custom slug
- status set to `publish`

Important behavior:
- Only process truly new article URLs.
- Use RSS as the source of truth for new items.
- Keep the exact original title from the source article.
- Keep the original source image.
- Rewrite only the body content through OpenRouter.
- Skip duplicates using workflow static data keyed by article URL.
- If extraction fails, do not publish.

Use these nodes in this order:
1. Schedule Trigger
2. RSS Feed Read
3. Code node named `Filter New URLs`
4. HTTP Request node named `Fetch Article HTML`
5. HTML node named `Extract Article`
6. Code node named `Prepare Content`
7. HTTP Request node named `Rewrite With OpenRouter`
8. Code node named `Build Post Payload`
9. HTTP Request node named `Download Image`
10. HTTP Request node named `Upload WordPress Media`
11. HTTP Request node named `Create WordPress Post`

Use this schedule:
- every 10 minutes

Use this RSS URL:
- `https://www.vwc.org.au/feed/`

Node details:

`Filter New URLs` code:
```javascript
const staticData = getWorkflowStaticData('global');
staticData.seen = staticData.seen || {};

const output = [];

for (const item of items) {
  const url = item.json.link || item.json.guid || item.json.id;
  if (!url) continue;
  if (staticData.seen[url]) continue;
  staticData.seen[url] = new Date().toISOString();
  output.push({
    json: {
      sourceUrl: url,
      rssTitle: item.json.title || '',
      rssPubDate: item.json.isoDate || item.json.pubDate || '',
    },
  });
}

return output;
```

`Fetch Article HTML`:
- Method: GET
- URL: `={{$json.sourceUrl}}`
- Response format: String

`Extract Article`:
- Source data: JSON field from previous node response body
- Extract these values:
  - `title` from `h1.entry-title`
  - `contentHtml` from `article .entry-content`
  - `imageUrl` from `meta[property="og:image"]` attribute `content`
  - `fallbackImage` from `article img` attribute `src`

`Prepare Content` code:
```javascript
function stripHtml(html) {
  return (html || '')
    .replace(/<script[\s\S]*?<\/script>/gi, '')
    .replace(/<style[\s\S]*?<\/style>/gi, '')
    .replace(/<noscript[\s\S]*?<\/noscript>/gi, '')
    .replace(/\sdata-[^=]+="[^"]*"/g, '')
    .trim();
}

const title = $json.title || $json.rssTitle || '';
const imageUrl = $json.imageUrl || $json.fallbackImage || '';
const sourceUrl = $json.sourceUrl;
const cleanedHtml = stripHtml($json.contentHtml || '');

if (!title || !imageUrl || !cleanedHtml || !sourceUrl) {
  throw new Error('Missing title, image, content, or source URL');
}

return [{
  json: {
    sourceUrl,
    originalTitle: title.trim(),
    imageUrl,
    originalHtml: cleanedHtml,
    rewritePrompt: [
      'Rewrite the following article into a fresh, readable, natural news-style post.',
      'Keep all factual meaning intact.',
      'Do not add invented facts.',
      'Do not mention that it was rewritten.',
      'Return clean HTML only.',
      'Preserve paragraphs and subheadings when useful.',
      '',
      cleanedHtml,
    ].join('\n'),
  },
}];
```

`Rewrite With OpenRouter`:
- Method: POST
- URL: `https://openrouter.ai/api/v1/chat/completions`
- Send JSON body
- Headers:
  - `Authorization: Bearer {{$env.OPENROUTER_API_KEY}}`
  - `Content-Type: application/json`
  - `HTTP-Referer: {{$env.OPENROUTER_SITE_URL}}`
  - `X-Title: {{$env.OPENROUTER_APP_NAME}}`
- JSON body:
```json
{
  "model": "x-ai/grok-4.1-fast",
  "messages": [
    {
      "role": "system",
      "content": "You rewrite article bodies into original, human-readable HTML while preserving facts and avoiding plagiarism."
    },
    {
      "role": "user",
      "content": "={{$json.rewritePrompt}}"
    }
  ],
  "temperature": 0.5
}
```

`Build Post Payload` code:
```javascript
function slugifyShort(input) {
  const base = (input || '')
    .toLowerCase()
    .replace(/[^a-z0-9\s-]/g, '')
    .trim()
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
    .slice(0, 45)
    .replace(/-+$/g, '');

  const stamp = Date.now().toString().slice(-6);
  return `${base || 'post'}-${stamp}`;
}

const rewritten =
  $node["Rewrite With OpenRouter"].json?.choices?.[0]?.message?.content ||
  $json.rewrittenHtml ||
  '';

const originalTitle = $node["Prepare Content"].json.originalTitle;
const imageUrl = $node["Prepare Content"].json.imageUrl;
const sourceUrl = $node["Prepare Content"].json.sourceUrl;

if (!rewritten) {
  throw new Error('OpenRouter returned empty content');
}

return [{
  json: {
    sourceUrl,
    originalTitle,
    imageUrl,
    rewrittenHtml: rewritten,
    slug: slugifyShort(originalTitle),
  },
}];
```

`Download Image`:
- Method: GET
- URL: `={{$json.imageUrl}}`
- Download response as file
- Binary property: `data`

`Upload WordPress Media`:
- Method: POST
- URL: `={{$env.WP_BASE_URL.replace(/\\/$/, '') + '/wp-json/wp/v2/media'}}`
- Authentication: Basic Auth using WordPress username and application password
- Send binary data from property `data`
- Headers:
  - `Content-Disposition: ={{'attachment; filename=\"' + $json.slug + '.jpg\"'}}`

`Create WordPress Post`:
- Method: POST
- URL: `={{$env.WP_BASE_URL.replace(/\\/$/, '') + '/wp-json/wp/v2/posts'}}`
- Authentication: Basic Auth using WordPress username and application password
- Send JSON body:
```json
{
  "title": "={{$json.originalTitle}}",
  "content": "={{$json.rewrittenHtml}}",
  "status": "publish",
  "slug": "={{$json.slug}}",
  "featured_media": "={{$node['Upload WordPress Media'].json.id}}",
  "meta": {
    "source_url": "={{$json.sourceUrl}}"
  }
}
```

Use error handling:
- stop the workflow when article extraction or rewrite fails
- do not create the WordPress post if media upload fails

Expected environment variables:
- `OPENROUTER_API_KEY`
- `OPENROUTER_SITE_URL`
- `OPENROUTER_APP_NAME`
- `WP_BASE_URL`

Expected credentials:
- WordPress Basic Auth using username + application password

Keep the workflow import-friendly and activate-ready.
