FROM php:8.1-cli

RUN apt-get update && apt-get install -y libpq-dev unzip \
    && docker-php-ext-install pdo_mysql pdo \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    #Installing Composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD php/default.ini /usr/local/etc/php/conf.d/php.ini
ADD php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /app
