FROM php:8-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 9000