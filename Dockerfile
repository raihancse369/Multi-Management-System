FROM richarvey/nginx-php-fpm:8.2

# Copy application code to /var/www/html
COPY . /var/www/html/ 

# Make the start script executable
RUN chmod +x /var/www/html/start.sh

# Run Composer Install explicitly
RUN composer install --no-dev --optimize-autoloader

# Image config
ENV SKIP_COMPOSER 1 
ENV WEBROOT /var/www/html/public
# ... (The rest of your ENV settings)

# Change CMD to point to the correct path
CMD ["/var/www/html/start.sh"]
