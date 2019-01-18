FROM php:7.3-fpm

WORKDIR /app

RUN apt-get update\
  && apt-get install -y git zip unzip

RUN docker-php-ext-install pdo_mysql

RUN cd /usr/local/bin\
  && curl -sS https://getcomposer.org/installer | php\
  && mv composer.phar /usr/local/bin/composer\
  && composer global require "laravel/lumen-installer"

EXPOSE 80
