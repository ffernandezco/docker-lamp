FROM php:7.2.2-apache

# Configuramos Apache para que cumpla con las reglas de .htaccess y se aplique la estructura correcta
RUN a2enmod rewrite headers
COPY ./app/.htaccess /var/www/html/.htaccess
RUN service apache2 restart

RUN docker-php-ext-install mysqli