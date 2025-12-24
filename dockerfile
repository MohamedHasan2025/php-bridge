FROM php:8.2-apache

# Install PHP extensions
RUN apt-get update && apt-get install -y libzip-dev unzip git
RUN docker-php-ext-install pdo pdo_mysql

# Copy project
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Expose port
EXPOSE 80
