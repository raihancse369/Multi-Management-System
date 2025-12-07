FROM php:8.2-fpm

RUN apt update && apt install -y nginx zip unzip curl

COPY . /var/www/html
WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader

RUN php artisan key:generate && \
    php artisan config:cache && \
    php artisan route:cache

CMD service nginx start && php-fpm

