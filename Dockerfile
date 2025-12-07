FROM php:8.2-fpm

# Install system packages (added libpq-dev for Postgres)
RUN apt-get update && apt-get install -y nginx zip unzip git curl nodejs npm libpq-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Build frontend assets
RUN npm install && npm run build

# Copy nginx config
COPY conf/nginx/nginx-site.conf /etc/nginx/sites-enabled/default

RUN chown -R www-data:www-data /var/www/html

# Generate env
RUN cp .env.example .env && php artisan key:generate

EXPOSE 80

CMD service nginx start && php-fpm

