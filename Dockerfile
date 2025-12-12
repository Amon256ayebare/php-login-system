FROM php:8.2-apache

# Install MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project
COPY . /var/www/html/

# Render requires Apache to listen on $PORT
RUN sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
RUN sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-enabled/000-default.conf

# Expose the Render port
EXPOSE ${PORT}

# Start apache
CMD ["apache2-foreground"]
