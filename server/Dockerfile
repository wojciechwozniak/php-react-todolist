# Use the official PHP 8.2 runtime as a parent image
FROM php:8.2-apache

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Enable mod_allowmethods for Apache
RUN a2enmod allowmethods

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the PHP application to the container
COPY ./.htaccess .
COPY . .

# Make sure the PHP application has the required permissions
RUN chmod 777 /var/www/html/tasks.json

# Configure Apache to allow specified methods
RUN echo '<Location "/">' >> /etc/apache2/conf-available/allowmethods.conf \
    && echo '    AllowMethods GET PUT PATCH DELETE OPTIONS POST' >> /etc/apache2/conf-available/allowmethods.conf \
    && echo '</Location>' >> /etc/apache2/conf-available/allowmethods.conf \
    && a2enconf allowmethods

# Expose the port that Apache will listen on
EXPOSE 80

# Start Apache web server
CMD ["apache2-foreground"]
