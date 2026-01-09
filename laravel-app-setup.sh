#!/bin/bash
# Setup Laravel 12 Application

cd /home/z/my-project

echo "🚀 Creating Laravel 12 application..."
composer create-project laravel/laravel uji-kompetensi-app --prefer-dist

cd uji-kompetensi-app

echo "✅ Installing Laravel Breeze..."
composer require laravel/breeze --dev

php artisan breeze:install blade

echo "✅ Installing Bootstrap 5..."
composer require laravel/breeze:^2.0 --dev

# Update .env file
echo "🔧 Configuring environment..."
cp .env.example .env

echo "📦 Done! Laravel app is ready at: /home/z/my-project/uji-kompetensi-app"
