#!/bin/bash

chmod -R a+rw /usr/local/www/storage/logs
chmod -R a+rw /usr/local/www/bootstrap/cache
chmod -R a+rw /usr/local/www/storage/framework/sessions
chmod -R a+rw /usr/local/www/storage/framework/views
chmod -R a+rw /usr/local/www/storage/framework/cache
chmod -R a+rw /usr/local/www/storage/framework/cache/data

find /usr/local/www/bootstrap/cache -type f -not -name '.gitignore' -print0 | xargs -0 rm -rf
find /usr/local/www/storage/framework/cache/data/* -type d -not -name '.gitignore' -print0 | xargs -0 rm -rf
find /usr/local/www/storage/framework/sessions -type f -not -name '.gitignore' -print0 | xargs -0 rm -rf
find /usr/local/www/storage/framework/views -type f -not -name '.gitignore' -print0 | xargs -0 rm -rf

rm -rf /usr/local/www/composer.lock /usr/local/www/vendor
composer install
