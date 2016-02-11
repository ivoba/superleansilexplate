FROM php:7.0-apache

MAINTAINER Ivo Bathke <ivo.bathke@gmail.com>

RUN a2enmod rewrite

RUN docker-php-ext-install opcache

COPY ./ /var/www/app/
COPY ./docker/apache-php7-prod/php.ini /usr/local/etc/php/
COPY ./docker/apache-php7-prod/apache2.conf /etc/apache2/

WORKDIR /var/www/app
