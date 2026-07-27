#!/bin/sh

echo "⏳ Waiting for database to be ready..."

# Tunggu sampai MySQL ready (max 60 detik)
MAX_TRIES=30
COUNT=0
until php -r "
    try {
        \$pdo = new PDO('mysql:host=db;port=3306;dbname=museum_talaga', 'laravel', 'secret');
        echo 'Connected';
    } catch (Exception \$e) {
        exit(1);
    }
" 2>/dev/null; do
    COUNT=$((COUNT+1))
    if [ $COUNT -ge $MAX_TRIES ]; then
        echo "❌ Database not ready after ${MAX_TRIES} attempts. Exiting."
        exit 1
    fi
    echo "   DB not ready yet... ($COUNT/$MAX_TRIES)"
    sleep 2
done

echo "✅ Database is ready!"

# Jalankan artisan commands
echo "🔧 Running artisan setup..."
php artisan package:discover --ansi
php artisan key:generate --no-interaction
php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction
php artisan storage:link --no-interaction
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🚀 Starting PHP-FPM..."
exec "$@"
