#! /bin/bash

# Defina o diretório de trabalho para o diretório do Laravel
WORKDIR=/var/www/api

chown -R www-data:www-data "/var/www/api"

if [ ! -f "$WORKDIR/vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f "$WORKDIR/.env" ]; then
    echo "Creating env file"
    cp $WORKDIR/.env.example $WORKDIR/.env
else
    echo "env file exists."
fi

# Mude para o diretório do Laravel
cd $WORKDIR

php artisan migrate
php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear

php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
exec docker-php-entrypoint "$@"
