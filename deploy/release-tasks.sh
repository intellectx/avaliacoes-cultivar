#!/usr/bin/env bash

set -e

echo "Running migrations..."
php artisan migrate
echo "Done."

echo "Clearing Yii Framework cache..."
php artisan config:cache
php artisan config:clear
chmod -R 775 storage
rm -rf ./public/assets/*
echo "Done."
