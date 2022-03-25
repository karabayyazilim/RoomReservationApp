FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev unzip zip \
    curl \
    wget \
    git \
    jpegoptim optipng pngquant gifsicle \
    && docker-php-ext-configure mysqli \
    && docker-php-ext-install pdo_mysql pdo \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD php/default.ini /usr/local/etc/php/conf.d/php.ini
ADD php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /app
