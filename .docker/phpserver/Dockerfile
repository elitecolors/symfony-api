FROM php:8.2-fpm


RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Configure Xdebug
RUN echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=172.21.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


# Install Bash
RUN apt-get update && \
    apt-get install -y bash && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/symfony_docker

#Add shell to www-data user to allow to login.
RUN chsh -s /bin/bash www-data

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash

# Git update
RUN git config --global --add safe.directory /var/www/symfony_docker

RUN usermod -u 1000 www-data
RUN usermod -a -G users www-data
RUN chown -R www-data:www-data /var/www


