#!/bin/bash
set -e

APP_FOLDER=/home/b0ston/staging.bostonfirearms.com
#APP_FOLDER=/var/www/bf_v2/_site/web
#APP_FOLDER=/home/bogdan/projects/local/www/bf_v2/_site/web

echo "****"
echo "Update from Git"
git -C $APP_FOLDER pull

echo "****"
echo "Composer install"
composer --working-dir=${APP_FOLDER} install

echo "****"
echo "Run migrations"
php artisan migrate

echo "****"
echo "Clear caches"
php artisan optimize:clear
php artisan optimize
php artisan route:cache
