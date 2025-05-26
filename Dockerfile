# Use official PHP-FPM Alpine image
FROM php:8.3-fpm-alpine

# Install only needed PHP extensions (none for your mini app)
# RUN docker-php-ext-install pdo pdo_mysql (if needed)

# Copy app files
COPY . /var/www/html/

# Set permissions for linkz.json
RUN chown -R www-data:www-data /var/www/html/linkz.json && chmod 664 /var/www/html/linkz.json

# Use www-data user for security
USER www-data

# Expose port 9000 for PHP-FPM
EXPOSE 80

CMD ["php-fpm"]
