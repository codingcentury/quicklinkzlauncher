# Use PHP 8.3 FPM Alpine image
FROM php:8.3-fpm-alpine

# Install Nginx and common tools
RUN apk add --no-cache nginx bash curl

# Create working directory
WORKDIR /quicklinkzlauncher

# Copy all project files into the container
COPY . /quicklinkzlauncher

# Ensure proper ownership and permissions
RUN chown -R www-data:www-data /quicklinkzlauncher \
    && chmod -R 755 /quicklinkzlauncher \
    && touch /quicklinkzlauncher/linkz.json \
    && chown www-data:www-data /quicklinkzlauncher/linkz.json \
    && chmod 664 /quicklinkzlauncher/linkz.json

# Copy Nginx config and startup script
COPY nginx.conf /etc/nginx/nginx.conf
COPY run.sh /run.sh

# Make startup script executable
RUN chmod +x /run.sh

# Expose HTTP port
EXPOSE 80

# Start PHP-FPM and Nginx
CMD ["/run.sh"]
