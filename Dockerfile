FROM php:8.3-fpm-alpine

# Install Nginx
RUN apk add --no-cache nginx

# Copy project files
COPY . /var/www/html

# Copy Nginx config
COPY nginx.conf /etc/nginx/nginx.conf

# Copy startup script
COPY run.sh /run.sh
RUN chmod +x /run.sh

EXPOSE 80

CMD ["/run.sh"]
