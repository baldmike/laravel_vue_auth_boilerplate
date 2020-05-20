FROM php:7.2-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

COPY --chown=www-data:www-data ./ /var/www

RUN apk add --update nodejs npm

# COPY --chown=www-data:www-data ./.env.example /var/www/.env
