FROM php:8.2-fpm-alpine
WORKDIR /var/www/html
COPY . .

RUN docker-php-ext-install mysqli pdo_mysql pdo

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN composer install

RUN chmod -R 777 storage
