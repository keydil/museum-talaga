#!/bin/bash
set -e

echo "🔧 Menjalankan setup aplikasi Museum Talaga..."

echo "1. Discover packages..."
php artisan package:discover --ansi

echo "3. Menjalankan Database Migrations..."
php artisan migrate --force

echo "4. Membersihkan dan rebuild cache..."
php artisan optimize:clear
php artisan config:cache
php artisan storage:link --force

echo "5. Memulai Server Apache..."
echo "✅ Setup selesai! Aplikasi siap diakses."
exec apache2-foreground
