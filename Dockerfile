FROM composer:2 AS composer
FROM php:8.1-fpm-alpine AS php-fpm
FROM nginx:1.21-alpine AS nginx

FROM composer AS vendor
COPY kudosgen/composer.json kudosgen/composer.lock ./
RUN composer validate && composer install -n --ignore-platform-reqs --no-autoloader --no-dev --prefer-dist

FROM php-fpm AS fpm