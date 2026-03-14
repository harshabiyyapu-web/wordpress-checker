# n8n Variables To Create

Create these variables in your n8n project before importing or activating the workflow:

- `OPENROUTER_API_KEY`
- `OPENROUTER_SITE_URL`
- `OPENROUTER_APP_NAME`
- `WP_BASE_URL`
- `WP_BASIC_AUTH`

## Values

- `OPENROUTER_API_KEY`
  - your OpenRouter API key
- `OPENROUTER_SITE_URL`
  - your website URL, for example `https://yourdomain.com`
- `OPENROUTER_APP_NAME`
  - any label for OpenRouter usage, for example `VWC Auto Publisher`
- `WP_BASE_URL`
  - your WordPress site base URL, for example `https://yourdomain.com`
- `WP_BASIC_AUTH`
  - base64 of `wordpress_username:application_password`

## How to create `WP_BASIC_AUTH`

If your WordPress username is `admin` and your application password is `abcd efgh ijkl mnop qrst uvwx`, generate:

```text
admin:abcd efgh ijkl mnop qrst uvwx
```

Then base64 encode that full string and store the result as `WP_BASIC_AUTH`.

## Important note

The workflow stores processed source URLs in workflow static data. This only persists when the workflow is active and runs normally from the trigger. Manual test runs do not reliably save that dedupe state.
