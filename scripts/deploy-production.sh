#!/usr/bin/env bash
# This script is for VPS / SSH hosts only.
# Hiox shared hosting has no SSH — production deploy uses GitHub Actions FTP instead.
# After schema changes on shared hosting, run migrations via phpMyAdmin SQL or ask the host for CLI access.

set -euo pipefail

cd "$(dirname "$0")/.."

echo "==> Installing PHP dependencies"
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

echo "==> Linking storage"
php artisan storage:link --force || true

echo "==> Running migrations"
php artisan migrate --force

echo "==> Caching config / routes / views"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache || true

echo "==> Restarting queues (if any)"
php artisan queue:restart || true

echo "==> Production deploy finished"
