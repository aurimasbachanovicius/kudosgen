FROM composer:2 AS composer

FROM composer AS vendor
WORKDIR /var/www/html
COPY api/composer.json api/composer.lock ./
RUN composer validate && composer install -n --ignore-platform-reqs --no-autoloader --no-dev --prefer-dist

FROM php:8.1-fpm-alpine as php
WORKDIR /var/www/html
RUN apk add zlib zlib-dev libpng-dev freetype-dev jpeg-dev curl-dev supervisor
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY infrastructure/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
EXPOSE 8080 9000

FROM php as php-prod
COPY --from=vendor /var/www/html/composer.json /var/www/html/composer.lock ./
COPY --from=vendor /var/www/html/vendor ./vendor
COPY api/src ./src
COPY api/static ./static
COPY api/ws.php ./
COPY api/index.php ./
RUN composer dump-autoload -n -o --no-scripts --no-dev && composer check-platform-reqs

FROM node:19-alpine as node
WORKDIR /var/www/html

FROM node as frontend
COPY frontend ./
RUN npm install
RUN npm run build

FROM nginx:alpine as nginx
WORKDIR /var/www/html
ARG FASTCGI_PASS_HOST
ENV FASTCGI_PASS_HOST $FASTCGI_PASS_HOST
COPY --from=frontend /var/www/html/build ./frontend

FROM nginx as nginx-prod
COPY infrastructure/nginx/default.conf.template /etc/nginx/templates/default.conf.template
