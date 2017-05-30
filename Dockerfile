FROM php:7.1.5-cli

RUN docker-php-ext-install pdo_mysql

WORKDIR /usr/src/symfony_app/
