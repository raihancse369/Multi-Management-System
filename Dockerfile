FROM php:8.2-fpm

# Install system packages + postgres driver
RUN apt-get update && apt-get install -y nginx zip unzip git curl nodejs npm libpq-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

WORKDIR /var/www/html

COPY . .

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Node assets
RUN npm install && npm run build

COPY conf/nginx/nginx-site.conf /etc/nginx/sites-enabled/default
COPY conf/php-fpm.d/zz-custom.conf /usr/local/etc/php-fpm.d/zz-custom.conf

RUN chown -R www-data:www-data /var/www/html

# Laravel commands
RUN cp .env.example .env && php artisan key:generate
RUN php artisan storage:link
RUN chmod -R 775 storage bootstrap/cache
RUN php artisan config:clear && php artisan cache:clear && php artisan route:clear

EXPOSE 80

CMD ["sh", "-c", "service nginx start && php-fpm"]

