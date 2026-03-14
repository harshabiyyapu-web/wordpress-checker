# VWC RSS to WordPress Automation

## What to use

Use `n8n` with the VWC RSS feed as the trigger. Use page scraping only for the individual article page so you can extract the exact title, full content, and main image. Then send only the article body to OpenRouter and publish the result to your WordPress site.

`makafeli/n8n-workflow-builder` is useful only as a builder layer for creating or updating the workflow in your n8n instance through MCP. It is not the scraper itself.

## Expected flow

1. Trigger every 10 minutes.
2. Read `https://www.vwc.org.au/feed/`.
3. Skip URLs already processed.
4. Fetch each new article page.
5. Extract:
   - exact title
   - main content HTML
   - featured image URL
6. Rewrite only the body with OpenRouter `x-ai/grok-4.1-fast`.
7. Download the original image.
8. Upload image to your WordPress media library.
9. Create a WordPress post with:
   - exact original title
   - rewritten content
   - short custom slug
   - featured image
   - published status

## Required credentials

You need these before building the workflow:

- `n8n` instance
- OpenRouter API key
- WordPress admin username
- WordPress application password
- Your WordPress base URL, for example `https://yourdomain.com`

## Suggested n8n nodes

Use this node order:

1. `Schedule Trigger`
2. `RSS Feed Read`
3. `Code` named `Filter New URLs`
4. `HTTP Request` named `Fetch Article HTML`
5. `HTML` named `Extract Article`
6. `Code` named `Prepare Content`
7. `HTTP Request` named `Rewrite With OpenRouter`
8. `Code` named `Build Post Payload`
9. `HTTP Request` named `Download Image`
10. `HTTP Request` named `Upload WordPress Media`
11. `HTTP Request` named `Create WordPress Post`

## Why this is the best method

- RSS is the stable source for detecting new articles.
- Scraping only the article page is much less fragile than scraping the homepage.
- OpenRouter is used only where it adds value: rewriting the body.
- WordPress REST publishing is cleaner than browser automation.

## Notes on extraction

The VWC site homepage is WordPress-based and uses GeneratePress, so the likely article selectors are:

- title: `h1.entry-title`
- content: `article .entry-content`
- image: `meta[property="og:image"]`

If the theme changes, update only the extraction selectors. The rest of the workflow stays the same.

## Important limits

- If the RSS feed contains only excerpts, this workflow still works because it fetches the article page itself.
- If the site blocks bots later, you may need request headers or a rotating proxy, but do not start there.
- Keeping the exact original title and original image may create copyright or SEO risk. That is a business decision, not a technical blocker.

## How to use `makafeli/n8n-workflow-builder`

If you want to use the builder MCP server:

1. Connect `@makafeli/n8n-workflow-builder` to your n8n instance with `N8N_HOST` and `N8N_API_KEY`.
2. Give it the prompt from:
   - [vwc-rss-openrouter-wordpress-builder-prompt.md](/Users/harshabiyyapu/Documents/New project/n8n/vwc-rss-openrouter-wordpress-builder-prompt.md)
3. Let it create the workflow in n8n.
4. Review credentials and selectors.
5. Activate the workflow.

## If you want me to continue

The next useful step is one of these:

1. I can generate a direct n8n workflow JSON import file in this workspace.
2. I can tailor the workflow to your exact WordPress site URL and credentials format.
3. I can help you install and configure `makafeli/n8n-workflow-builder` against your n8n instance.
