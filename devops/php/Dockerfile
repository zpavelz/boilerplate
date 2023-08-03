FROM php:8.1.1-fpm

RUN apt-get update && \
    apt-get -y --no-install-recommends install \
        git \
        libzip-dev \
        supervisor \
        libxml2-dev \
        software-properties-common \
        curl \
        imagemagick \
        libcurl3-dev \
        libicu-dev \
        libfreetype6-dev \
        libjpeg-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libmagickwand-dev \
        libpq-dev \
        libpng-dev \
        libxml2-dev \
        libzip-dev \
        zlib1g-dev \
        default-mysql-client \
        openssh-client \
        nano \
        unzip \
        libcurl4-openssl-dev \
        libssl-dev

RUN docker-php-ext-configure bcmath && \
    docker-php-ext-install \
        soap \
        zip \
        curl \
        bcmath \
        pcntl \
        exif \
        gd \
        iconv \
        intl \
        mbstring \
        opcache \
        pdo_pgsql \
        pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 9000
