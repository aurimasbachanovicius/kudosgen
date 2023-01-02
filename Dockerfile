FROM composer:2 AS composer

FROM composer AS vendor
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer validate && composer install -n --ignore-platform-reqs --no-autoloader --no-dev --prefer-dist

FROM php:8.1-fpm-alpine as php
RUN apk add zlib zlib-dev libpng-dev freetype-dev jpeg-dev curl-dev
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd
COPY --from=composer /usr/bin/composer /usr/bin/composer

FROM php as php-prod
WORKDIR /var/www/html
COPY api ./
RUN composer dump-autoload -n -o --no-scripts --no-dev && composer check-platform-reqs

FROM nginx:alpine as nginx
WORKDIR /var/www/html

FROM nginx as nginx-prod
WORKDIR /var/www/html
COPY ./api/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./api ./

FROM node:19-alpine as frontend
WORKDIR /var/www/html
COPY ./frontend ./
RUN npm install && npm run dev