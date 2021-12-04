FROM composer:2 AS composer
FROM php:8.1-apache AS php-apache

FROM composer AS vendor
COPY kudosgen/composer.json kudosgen/composer.lock ./
RUN composer validate && composer install -n --ignore-platform-reqs --no-autoloader --no-dev --prefer-dist

FROM php-apache AS prod
WORKDIR /var/www/html

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=vendor /app/vendor ./
COPY kudosgen/composer.json kudosgen/composer.lock ./
COPY kudosgen/src ./src
COPY kudosgen/index.php ./

RUN composer dump-autoload -n -o --no-scripts --no-dev && composer check-platform-reqs