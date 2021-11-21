FROM php:7.4-fpm

ARG user
ARG uid

RUN apt-get update \
    && apt-get install -y wget git unzip libpq-dev libicu-dev libpng-dev libzip-dev libjpeg-dev libfreetype6-dev\
    && docker-php-ext-install pdo_mysql pcntl zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install exif

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www user

ENV PATH="$PATH:/var/www/vendor/bin"
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
RUN chown user ./

USER user

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-interaction --no-autoloader
COPY --chown=user:www . ./
RUN composer dump-autoload

RUN chmod -R 775 /var/www/bootstrap
RUN chmod -R 775 /var/www/storage
