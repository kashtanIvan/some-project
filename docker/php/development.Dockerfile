FROM php:7.4-fpm-buster

RUN apt-get update && apt-get install -y unzip libpng-dev libjpeg-dev libgif-dev libzip-dev

RUN docker-php-ext-install exif pdo pdo_mysql
RUN docker-php-ext-configure gd && docker-php-ext-install gd zip

RUN curl -Ss https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs build-essential
