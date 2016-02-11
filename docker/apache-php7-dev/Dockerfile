FROM php:7.0-apache

MAINTAINER Ivo Bathke <ivo.bathke@gmail.com>

RUN a2enmod rewrite

RUN docker-php-ext-install opcache

COPY php.ini /usr/local/etc/php/
COPY apache2.conf /etc/apache2/apache2.conf

WORKDIR /var/www/app
