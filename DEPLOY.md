# Deploy WordPress Checker to Coolify VPS

## Prerequisites

- A **Coolify** instance running on your VPS  
- A **GitHub** account  
- **Git** installed on your local machine

---

## Step 1 — Push the Project to GitHub

### 1a. Create a new GitHub repository

Go to [github.com/new](https://github.com/new) and create a **private** (or public) repository.  
Name it something like `wordpress-checker`. **Do NOT** initialize with a README.

### 1b. Push your local code

Open a terminal in your project folder and run:

```bash
cd "/Users/harshabiyyapu/Documents/New project"

git init
git add .
git commit -m "Initial commit – WordPress checker with Docker"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/wordpress-checker.git
git push -u origin main
```

> Replace `YOUR_USERNAME` with your actual GitHub username.

---

## Step 2 — Connect GitHub to Coolify

1. Open your **Coolify dashboard** (e.g. `https://coolify.your-vps.com`)
2. Go to **Sources** → **GitHub**
3. If not already connected, click **+ Add** and follow the OAuth flow to connect your GitHub account
4. Make sure the repository (`wordpress-checker`) is accessible to Coolify

---

## Step 3 — Create a New Resource in Coolify

1. In your Coolify dashboard, click **+ New Resource**
2. Select **"Docker Compose"** as the deployment type
3. Choose the **server** (your VPS) and the **environment** you want to deploy to
4. Select your **GitHub** source and pick the `wordpress-checker` repository
5. Set the **branch** to `main`

---

## Step 4 — Configure Build Settings

In the resource configuration page:

| Setting             | Value                |
|---------------------|----------------------|
| **Build Pack**      | Docker Compose       |
| **Docker Compose File** | `docker-compose.yml` |
| **Port**            | `3000`               |

### Domain / URL

- Under **Settings** → **General**, set a domain like `wpchecker.your-domain.com`
- Coolify will auto-provision an SSL certificate via Let's Encrypt

> **If you don't have a domain**: Coolify can generate a free subdomain like `random-slug.coolify.your-vps-ip.sslip.io`

---

## Step 5 — Deploy

1. Click **Deploy** in Coolify
2. Watch the build logs — you should see:
   - Docker image building (the multi-stage Dockerfile)
   - Container starting
   - Health check passing
3. Once deployed, Coolify will show the status as **Running** ✅

---

## Step 6 — Verify

Open your domain (e.g. `https://wpchecker.your-domain.com`) in a browser:

1. You should see the **"Check a list of sites for WordPress signatures"** page
2. Paste a URL (e.g. `wordpress.org`) into the textarea
3. Click **Run Check**
4. Verify you get results back (WordPress detected for wordpress.org)

---

## Updating the App

To deploy updates, simply push to `main`:

```bash
git add .
git commit -m "your update message"
git push
```

If you enabled **Auto Deploy** in Coolify settings, it will automatically redeploy. Otherwise, click **Deploy** manually in the Coolify dashboard.

---

## Troubleshooting

| Issue | Fix |
|---|---|
| **Build fails** | Check Coolify build logs. Make sure `package-lock.json` is committed |
| **Can't reach the app** | Verify port is set to `3000` in Coolify. Check the domain/DNS settings |
| **Health check failing** | Check container logs in Coolify for startup errors |
| **Timeouts on URL checks** | The app uses a 12s timeout per URL — this is normal for slow sites |
