FROM php:8.1-fpm-alpine as php

RUN apk add zlib zlib-dev libpng-dev freetype-dev jpeg-dev curl-dev

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd