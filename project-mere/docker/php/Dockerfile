FROM php:7.3-fpm
COPY php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev \
  && docker-php-ext-install pdo_mysql mysqli mbstring \
  && apt-get clean

# For composer
RUN apt-get update
RUN apt-get install -y git zip unzip libzip-dev
# composerのインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www/html

EXPOSE 80
# docker exec -it docker_php_1 /bin/bash で入る

