# Start with the official PHP 8.2 FPM image
FROM php:8.2-fpm-alpine

# Install Nginx and required extensions
RUN apk add --no-cache nginx

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code
WORKDIR /var/www/html
COPY . .

# Run Composer installation
RUN composer install --no-dev --optimize-autoloader

# Nginx config and entrypoint (You will need to add more setup here)
# ... (This requires more complex changes and may not be necessary if Option 1 works)

# Image config
ENV SKIP_COMPOSER 1 # Set this back to 1 if you ran it manually above
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
