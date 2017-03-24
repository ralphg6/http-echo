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

RUN apt-get update \
&& apt-get install curl php5-cli git -y \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /var/lib/http-echo/data && chmod -R 777 /var/lib/http-echo

VOLUME /var/lib/http-echo/data/

COPY ./ /var/www/html/

RUN composer update
