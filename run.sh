#!/bin/sh

# Start PHP-FPM
php-fpm &

# Start nginx in the foreground using exec to bind it as PID 1
exec nginx -g "daemon off;"
