FROM php:8.2 as php

RUN apt update -y \
    && apt-get install -y unzip libzip-dev libonig-dev libpq-dev libcurl4-gnutls-dev libsodium-dev libxml2-dev curl wget \
    && docker-php-ext-install pdo pdo_pgsql mbstring opcache sodium xml bcmath

WORKDIR /var/www
COPY ./api /var/www/api

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

ENV PORT=8000

COPY .docker/php/entrypoint.sh /
RUN chmod +x /entrypoint.sh

ENTRYPOINT [ "/entrypoint.sh" ]
