FROM php:8.2-apache
WORKDIR /var/www/html
EXPOSE 80
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd curl \
    && a2enmod env rewrite headers
COPY . /var/www/html
