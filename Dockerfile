FROM richarvey/nginx-php-fpm:latest

# Copy application code
COPY . /var/www/html

WORKDIR /var/www/html

# Image config
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Render specific configuration for port binding
ENV PORT 10000
ENV HOST 0.0.0.0

# Install composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Set permissions
RUN chown -R nginx:nginx /var/www/html/storage /var/www/html/bootstrap/cache

# Setup script
COPY ./scripts/docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

# Start the application
CMD ["/docker-entrypoint.sh"]