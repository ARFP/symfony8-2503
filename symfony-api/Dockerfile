FROM php:8.4-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

EXPOSE 80   

WORKDIR /var/www/html

RUN apt-get update -qq && apt-get install -qy \
    git \
    gnupg \
    zip \   
    unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install pdo_mysql opcache

COPY ./conf/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite
