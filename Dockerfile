FROM php:5.6-apache

RUN docker-php-source extract \
&& apt-get update \
&& apt-get install libmcrypt-dev libldap2-dev nano -y \
&& rm -rf /var/lib/apt/lists/* \
&& docker-php-ext-install pdo pdo_mysql \
&& a2enmod rewrite \
&& a2enmod ssl \
&& docker-php-source delete

RUN docker-php-ext-install sysvsem

COPY ./ /var/www/html/
