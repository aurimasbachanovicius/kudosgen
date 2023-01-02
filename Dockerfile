FROM composer:2 AS composer

FROM composer AS vendor
WORKDIR /var/www/html
COPY api/composer.json api/composer.lock ./
RUN composer validate && composer install -n --ignore-platform-reqs --no-autoloader --no-dev --prefer-dist

FROM php:8.1-fpm-alpine as php
RUN apk add zlib zlib-dev libpng-dev freetype-dev jpeg-dev curl-dev
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=vendor /var/www/html/vendor ./

FROM php as php-prod
WORKDIR /var/www/html
COPY --from=vendor /var/www/html/composer.json /var/www/html/composer.lock ./
COPY api/src ./src
COPY api/static ./static
COPY api/index.php ./
RUN composer dump-autoload -n -o --no-scripts --no-dev && composer check-platform-reqs

FROM nginx:alpine as nginx
WORKDIR /var/www/html

FROM nginx as nginx-prod
WORKDIR /var/www/html
ARG FASTCGI_PASS_HOST
ENV FASTCGI_PASS_HOST $FASTCGI_PASS_HOST
COPY nginx/default.conf.template /etc/nginx/templates/default.conf.template
COPY api/static ./static

FROM node:19-alpine as frontend
WORKDIR /var/www/html
COPY frontend ./
RUN npm install && npm run dev