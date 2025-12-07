FROM php:8.2-fpm

# Install system packages
RUN apt update && apt install -y nginx zip unzip git curl nodejs npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

# Setup working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Build frontend assets
RUN npm install && npm run build

# Copy custom nginx config
COPY conf/nginx/nginx-site.conf /etc/nginx/sites-enabled/default

RUN chown -R www-data:www-data /var/www/html

# Generate env
RUN cp .env.example .env && php artisan key:generate

# Expose port
EXPOSE 80

CMD service nginx start && php-fpm

