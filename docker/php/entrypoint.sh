#!/bin/sh
set -e

cd /var/www/html

echo "Waiting for MySQL..."
until php -r "new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . (getenv('DB_PORT') ?: '3306'), getenv('DB_USERNAME'), getenv('DB_PASSWORD') ?: '');" 2>/dev/null; do
  sleep 2
done
echo "MySQL is ready."

if [ ! -f vendor/autoload.php ]; then
  echo "Installing Composer dependencies..."
  composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if [ ! -f .env ]; then
  echo "WARNING: .env is missing. Copy .env.example to .env before starting."
fi

mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true
chmod -R ug+rwx storage bootstrap/cache 2>/dev/null || true

if [ -f artisan ]; then
  php artisan storage:link --force 2>/dev/null || true
  php artisan config:clear 2>/dev/null || true
  php artisan route:clear 2>/dev/null || true
  php artisan view:clear 2>/dev/null || true
fi

exec docker-php-entrypoint "$@"
