# Use official PHP 8.2 FPM image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    zip unzip git curl \
    nodejs npm \
    libpng-dev libonig-dev libxml2-dev libpq-dev default-mysql-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install frontend dependencies and build assets
RUN npm install && npm run build

# Copy Nginx configuration
COPY conf/nginx/nginx-site.conf /etc/nginx/sites-enabled/default

# Copy custom PHP-FPM configuration if needed
COPY conf/php-fpm.d/zz-custom.conf /usr/local/etc/php-fpm.d/zz-custom.conf

# Clear Laravel caches
RUN php artisan config:clear && php artisan cache:clear && php artisan route:clear

# Copy .env and generate key (Render sets env variables anyway)
RUN cp .env.example .env && php artisan key:generate

# Expose ports
EXPOSE 80

# Start services
CMD ["sh", "-c", "service nginx start && php-fpm"]

