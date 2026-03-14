# VWC to WordPress Automation One-Pager

## Objective

Build an automated `n8n` workflow that monitors the VWC website for newly published articles, captures the original article title, image, and full content, rewrites the content through OpenRouter using `x-ai/grok-4.1-fast`, and publishes the result automatically to a WordPress site.

The publishing rules are:

- keep the exact original article title
- keep the original article image as the featured image
- rewrite only the article body
- generate a short custom permalink slug
- auto-publish the new WordPress post

## Source and Trigger

The source website is:

- `https://www.vwc.org.au/`

The workflow should detect new content through the site RSS feed:

- `https://www.vwc.org.au/feed/`

This is the preferred trigger method because RSS is more stable and reliable than monitoring homepage HTML changes.

## Functional Requirements

The workflow must:

1. Check the VWC RSS feed every 10 minutes.
2. Identify only newly published articles.
3. Skip URLs that were already processed earlier.
4. Open the full article page for each new RSS item.
5. Extract:
   - the exact article title
   - the main image URL
   - the full article body HTML
6. Send only the article body to OpenRouter for rewriting.
7. Download the original source image.
8. Upload that image to the destination WordPress media library.
9. Create a new WordPress post using:
   - original title
   - rewritten body content
   - uploaded featured image
   - short slug
   - status `publish`
10. Stop publishing if extraction, rewriting, or image upload fails.

## Business Rules

- RSS is the source of truth for detecting new articles.
- The title must remain exactly the same as the source article title.
- The image must remain the same as the source article image.
- Only the body content should be rewritten.
- Duplicate publishing must be prevented.
- Failed items should not create partial posts.

## Required Inputs and Credentials

The workflow needs these values:

- `OPENROUTER_API_KEY`
- `OPENROUTER_SITE_URL`
- `OPENROUTER_APP_NAME`
- `WP_BASE_URL`
- `WP_BASIC_AUTH`

`WP_BASIC_AUTH` should be the base64 version of:

```text
wordpress_username:application_password
```

## Extraction Rules

The VWC site appears to use a standard WordPress article structure, so the first selectors to use are:

- title: `h1.entry-title`
- content: `article .entry-content`
- image: `meta[property="og:image"]`
- fallback image: `article img`

If the theme changes later, only these extraction selectors should need to change.

## n8n Workflow Shape

The workflow is a straight pipeline with one item flowing from detection to publication.

```text
Schedule Trigger
  -> RSS Read
  -> Filter New URLs
  -> Fetch Article HTML
  -> Extract Article
  -> Prepare Content
  -> Rewrite With OpenRouter
  -> Build Post Payload
  -> Download Image
  -> Upload WordPress Media
  -> Create WordPress Post
```

## Node-by-Node Flow

### 1. Schedule Trigger

- Runs every 10 minutes.
- Starts the workflow automatically.

### 2. RSS Read

- Reads `https://www.vwc.org.au/feed/`.
- Returns the latest RSS items.

### 3. Filter New URLs

- Reads each RSS item URL.
- Checks workflow static data for previously processed URLs.
- Drops duplicates.
- Passes forward only unseen article URLs.

Output at this point:

- `sourceUrl`
- `rssTitle`
- `rssPubDate`

### 4. Fetch Article HTML

- Sends an HTTP GET request to the article URL.
- Retrieves the raw HTML of the article page.

### 5. Extract Article

- Parses the HTML page.
- Extracts:
  - exact title
  - full article content block
  - Open Graph image
  - fallback inline image

Output at this point:

- `title`
- `contentHtml`
- `imageUrl`
- `fallbackImage`

### 6. Prepare Content

- Chooses the best available image URL.
- Cleans article HTML by removing unwanted script/style fragments.
- Verifies that title, image, content, and source URL all exist.
- Builds the prompt for OpenRouter.

Output at this point:

- `sourceUrl`
- `originalTitle`
- `imageUrl`
- `originalHtml`
- `rewritePrompt`

### 7. Rewrite With OpenRouter

- Sends the body content to OpenRouter.
- Uses model `x-ai/grok-4.1-fast`.
- Requests rewritten HTML output only.
- Keeps factual meaning intact.

Output at this point:

- rewritten HTML in the LLM response body

### 8. Build Post Payload

- Reads the rewritten HTML.
- Generates a short slug from the original title.
- Prepares the values needed for WordPress publishing.

Output at this point:

- `sourceUrl`
- `originalTitle`
- `imageUrl`
- `rewrittenHtml`
- `slug`

### 9. Download Image

- Downloads the original article image from the source URL.
- Converts it to binary file data for media upload.

### 10. Upload WordPress Media

- Uploads the image into the destination WordPress media library.
- Returns the created WordPress media ID.

Output at this point:

- WordPress media object
- media ID

### 11. Create WordPress Post

- Creates a new post through the WordPress REST API.
- Uses:
  - exact original title
  - rewritten article HTML
  - generated short slug
  - uploaded media ID as featured image
  - status `publish`

Final result:

- a published WordPress article based on the new VWC source article

## Data Flow Summary

The workflow transforms data in this order:

1. RSS item URL detected
2. Article page fetched
3. Title, image, and body extracted
4. Body rewritten by AI
5. Image uploaded to WordPress
6. Post created and published

## Duplicate Prevention

Duplicate prevention is handled through `workflow static data` in n8n.

Logic:

- when a source article URL is seen for the first time, store it
- if the same URL appears again in the RSS feed later, skip it

This prevents reposting the same article multiple times.

## Failure Handling

The workflow should fail fast and stop the current item if:

- title extraction fails
- content extraction fails
- image extraction fails
- OpenRouter returns empty content
- WordPress media upload fails

The WordPress post must not be created unless all previous steps succeed.

## Why This Design Is Best

- RSS is the cleanest way to detect new content.
- Scraping only the article page is lighter and more stable than scraping the full site.
- OpenRouter is used only where needed, for body rewriting.
- WordPress REST API publishing is cleaner and more reliable than browser automation.
- The workflow is simple enough to maintain when site selectors change.

## Operational Notes

- Test the workflow first with one live RSS item.
- Confirm that the selectors still match the source site HTML.
- Validate that your WordPress site accepts Application Password authentication.
- Confirm that permalink settings allow custom slugs.
- Review copyright and SEO implications of reusing exact title and original image.

## Deliverables

The current project already includes:

- [vwc-rss-openrouter-wordpress.workflow.json](/Users/harshabiyyapu/Documents/New project/n8n/vwc-rss-openrouter-wordpress.workflow.json)
- [vwc-rss-openrouter-wordpress-variables.md](/Users/harshabiyyapu/Documents/New project/n8n/vwc-rss-openrouter-wordpress-variables.md)
- [vwc-rss-openrouter-wordpress-setup.md](/Users/harshabiyyapu/Documents/New project/n8n/vwc-rss-openrouter-wordpress-setup.md)

This one-pager should be used as the implementation and review summary for the automation.
