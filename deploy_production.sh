#!/bin/bash
# Deployment helper for production server

set -euo pipefail

echo ">>> Ensuring dependencies are installed"
composer install --no-dev --optimize-autoloader

if [ -f package-lock.json ] || [ -f yarn.lock ]; then
    echo ">>> Installing JS dependencies"
    if command -v npm >/dev/null 2>&1; then
        npm ci
        npm run build
    elif command -v yarn >/dev/null 2>&1; then
        yarn install --frozen-lockfile
        yarn build
    else
        echo "Node package manager not found; skipping asset build" >&2
    fi
fi

echo ">>> Running database migrations"
php artisan migrate --force

echo ">>> Clearing all caches first"
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

echo ">>> Ensuring storage permissions"
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || echo "  (skipped chown - run manually with sudo if needed)"

echo ">>> Linking storage directory"
php artisan storage:link --force

echo ">>> Caching configuration for production"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ">>> Optimizing framework bootstrap"
php artisan optimize

echo "✅ Deployment completed successfully!"
