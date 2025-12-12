# Dockerfile for Render - PHP + Apache with mysqli
FROM php:8.2-apache

# Copy project files
COPY . /var/www/html/

# Install mysqli and required extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ensure permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Apache runs by default in this image
