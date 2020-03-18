#!/bin/bash

printf "\n\nStarting PHP 7.0 daemon...\n\n"
php-fpm7 --daemonize

printf "\nClearing Cache...\n"
php artisan config:cache

printf "\nCreating passport key...\n"
php artisan passport:keys


printf "Starting Nginx...\n\n"
set -e

if [[ "$1" == -* ]]; then
    set -- nginx -g daemon off; "$@"
fi

exec "$@"