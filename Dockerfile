FROM php:8.2-apache

RUN a2enmod rewrite

COPY . /var/www/html/

RUN chown www-data:www-data /var/www/html/linkz.json && chmod 664 /var/www/html/linkz.json

EXPOSE 80
