# Deploying to Render

This document explains how to deploy the `Cloth_API` Laravel app to Render.com using the included `Dockerfile`.

> WARNING: Do not commit your `.env` file to source control. Set environment variables in Render's dashboard.

## 1. Prepare repository

-   Ensure your code is pushed to GitHub (branch `main`).
-   Confirm `Dockerfile` and `.dockerignore` are present in the repo root.

## 2. Create a PostgreSQL database on Render

1. Log in to https://render.com and connect your GitHub account.
2. Click **New > PostgreSQL**.
3. Name the database (for example `clothes-api-db`) and pick a region.
4. Create the DB and copy the provided connection details (host, port, database, user, password).

## 3. Create the Web Service (Docker)

1. Click **New > Web Service**.
2. Select the `Cloth_API` repository and `main` branch.
3. Choose **Docker** as the runtime (Render will use the repository `Dockerfile`).
4. Choose a service name (e.g., `clothes-api`).
5. Create the service.

> You do not need to provide separate Build/Start commands when using Docker — Render uses the `Dockerfile`'s `CMD`.

## 4. Configure Environment Variables in Render

In your Web Service, open the **Environment** tab and add the following variables. Fill the `DB_*` values with the values from the Render PostgreSQL dashboard.

-   `APP_NAME=Laravel`
-   `APP_ENV=production`
-   `APP_KEY=base64:9gKrYk5ND42Um4sOSL2h/dskAaeB4EwG1BhFXFFPpYg=` # or generate a new one locally and copy
-   `APP_DEBUG=false`
-   `APP_URL=https://cloth-api-6ghz.onrender.com` # update with the actual service URL after deploy

-   `DB_CONNECTION=pgsql`
-   `DB_HOST=dpg-d4le8124d50c73e1e1g0-a` # example: provided by Render (host only)
-   `DB_PORT=5432`
-   `DB_DATABASE=clothes_api_db` # your Render DB name
-   `DB_USERNAME=clothes_api_db_user` # your Render DB user
-   `DB_PASSWORD=<render-db-password>` # set this secret in Render dashboard (do not commit)

Optional example (single connection string) that you can set as `DATABASE_URL` in Render:

```
postgresql://clothes_api_db_user:<render-db-password>@dpg-d4le8124d50c73e1e1g0-a:5432/clothes_api_db
```

-   `LOG_CHANNEL=stack`
-   `CACHE_STORE=database`
-   `QUEUE_CONNECTION=database`
-   `SESSION_DRIVER=database`

Optional (if you use these services):

-   `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`, `AWS_BUCKET`

Save the environment variables.

## 5. Deploy and Run Migrations/Seeders

-   Once the Web Service is created, Render will build the Docker image and launch the container.
-   The `Dockerfile` in this repo runs `php artisan migrate --force` on start. If you want seeders to run automatically, either:
    -   Modify the `CMD` in the `Dockerfile` to include `php artisan db:seed --force` (be careful with repeated runs), or
    -   Run a one-off shell/command in Render after the service is deployed:

```
php artisan migrate --force
php artisan db:seed --force
```

Recommended production steps (safer):

-   Prefer running migrations manually the first time to avoid container restart loops if env vars are missing. Use the Render Shell to run migrations after env vars are set.
-   Run seeders only once (manual run) to avoid inserting duplicate data on redeploys. Example one-off commands to run after deploy:

```bash
# Run migrations
php artisan migrate --force

# OPTIONAL: run seeders once (do not run on every deploy)
php artisan db:seed --force

# Make storage visible and cache configuration/routes for production
php artisan storage:link
php artisan config:cache
php artisan route:cache
```

## 6. Testing

-   Visit `https://your-service-name.onrender.com` — the app redirects to `/api/products`.
-   Check the products endpoint: `https://your-service-name.onrender.com/api/products`.

Health check suggestion:

-   In the Render service settings you can set a Health Check path (for example `/api/products` or `/ping`) so Render can report the service as healthy and restart it when it becomes unhealthy.

## 7. Useful Local Commands

-   Generate an app key locally (copy to Render if preferred):

```
php artisan key:generate --show
```

-   Run migrations and seed locally:

```
php artisan migrate
php artisan db:seed
```

-   Serve app locally:

```
php artisan serve --host=127.0.0.1 --port=8000
```

## 8. Notes & Troubleshooting

-   If you see `could not find driver`, ensure the `pdo_pgsql` and `pgsql` PHP extensions are enabled in the runtime. The `Dockerfile` in this repo installs `pdo_pgsql`.
-   Keep `.env` out of VCS. Use Render environment variables for secrets.
-   Logs: Use the Render dashboard **Logs** tab to debug build/start/migration errors.

Other production recommendations:

-   Filesystem persistence: the container filesystem is ephemeral. If your app accepts user uploads, configure an external storage service (AWS S3) and set `FILESYSTEM_DISK=s3` plus the `AWS_*` env vars. Otherwise uploaded files will be lost after deploys.
-   Seeding caution: run `db:seed` only once (or write idempotent seeders). Avoid running seeders automatically from the `Dockerfile` on every start.
-   Performance: run `php artisan config:cache` and `php artisan route:cache` after env vars are set to improve performance in production.

---

If you'd like, I can also add a short checklist to the repository `README.md` pointing to this file.
