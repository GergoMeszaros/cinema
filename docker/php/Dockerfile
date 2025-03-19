FROM node:16-alpine AS node-builder

WORKDIR /application

COPY package.json package-lock.json /application/

RUN npm install

FROM php:8.2-fpm

WORKDIR /application

RUN apt-get update \
    && apt-get install -y zip unzip curl libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

RUN apt-get update \
    && apt-get install -y curl gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY --from=node-builder /application /application
COPY . /application

RUN composer install --no-interaction --optimize-autoloader

RUN chmod +x docker/php/entrypoint.sh

ENTRYPOINT ["docker/php/entrypoint.sh"]
