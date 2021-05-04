#!/usr/bin/env bash

set -e

rm -rf ./env && touch ./env

heroku config:get APP_ENV -s  >> .env
heroku config:get APP_KEY -s  >> .env
heroku config:get DB_HOST -s  >> .env
heroku config:get DB_USERNAME -s  >> .env
heroku config:get DB_PASSWORD -s  >> .env
heroku config:get DB_DATABASE -s  >> .env

echo "Running migrations..."
php artisan migrate
echo "Done."

echo "Clearing Framework cache..."
php artisan config:cache
php artisan config:clear
chmod -R 775 storage
echo "Done."
