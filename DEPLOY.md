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
-   `APP_URL=https://your-service-name.onrender.com` # update with the actual service URL after deploy

-   `DB_CONNECTION=pgsql`
-   `DB_HOST=<render-db-host>`
-   `DB_PORT=5432`
-   `DB_DATABASE=<render-db-name>`
-   `DB_USERNAME=<render-db-user>`
-   `DB_PASSWORD=<render-db-password>`

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

## 6. Testing

-   Visit `https://your-service-name.onrender.com` — the app redirects to `/api/products`.
-   Check the products endpoint: `https://your-service-name.onrender.com/api/products`.

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

---

If you'd like, I can also add a short checklist to the repository `README.md` pointing to this file.
