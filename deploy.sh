#!/bin/bash
set -e

echo "🚀 Starting Deployment..."

# 1. Turn on maintenance mode
echo "🔧 Entering maintenance mode..."
php artisan down || true

# 2. Pull the latest code from git
echo "📥 Pulling latest code..."
git pull origin main

# 3. Install/update composer dependencies (optimized for production)
echo "📦 Installing composer dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# 4. Clear and rebuild Laravel caches
echo "🧹 Clearing caches..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Run database migrations safely
echo "🗄️ Running database migrations..."
php artisan migrate --force

# 6. Sync public folder to your public_html folder
# IMPORTANT: We exclude .htaccess and index.php so we don't overwrite your custom server settings!
echo "📂 Syncing public files to public_html/laravel/public..."
rsync -a public/ ../public_html/laravel/public/ --exclude=.htaccess --exclude=index.php

# 7. Turn off maintenance mode
echo "✅ Exiting maintenance mode..."
php artisan up

echo "🎉 Deployment finished successfully!"
