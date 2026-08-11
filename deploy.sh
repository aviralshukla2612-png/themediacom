#!/bin/bash
set -e

# Define the exact PHP 8.4 binary
PHP_BIN="/opt/alt/php84/usr/bin/php"

echo "🚀 Starting Deployment..."

# 1. Turn on maintenance mode
echo "🔧 Entering maintenance mode..."
$PHP_BIN artisan down || true

# 2. Pull the latest code from git
echo "📥 Pulling latest code..."
git pull origin main

# 3. Install/update composer dependencies (optimized for production)
# We use the specific PHP 8.4 binary to run Composer so it doesn't fail!
echo "📦 Installing composer dependencies..."
COMPOSER_BIN=$(which composer)
$PHP_BIN $COMPOSER_BIN install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# 4. Clear and rebuild Laravel caches
echo "🧹 Clearing caches..."
$PHP_BIN artisan optimize:clear

# 5. Run database migrations safely
echo "🗄️ Running database migrations..."
$PHP_BIN artisan migrate --force

# Create storage symlink if it doesn't exist
echo "🔗 Creating storage symlink..."
$PHP_BIN artisan storage:link || true

# 6. Sync public folder to your public_html folder
# IMPORTANT: We exclude .htaccess and index.php so we don't overwrite your custom server settings!
echo "📂 Syncing public files to public_html/laravel/public..."
rsync -a public/ ../public_html/laravel/public/ --exclude=.htaccess --exclude=index.php

# 7. Turn off maintenance mode
echo "✅ Exiting maintenance mode..."
$PHP_BIN artisan up

echo "🎉 Deployment finished successfully!"
