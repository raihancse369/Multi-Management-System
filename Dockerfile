# Use a PHP 8.2 compatible image to meet Composer's requirements
FROM richarvey/nginx-php-fpm:8.2

COPY . /var/www/html/ 

# Run Composer Install explicitly BEFORE starting the app
RUN composer install --no-dev --optimize-autoloader

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
