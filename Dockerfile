FROM php:7.2.2-apache

RUN echo 'ServerTokens Prod' >> /etc/apache2/apache2.conf && \
    echo 'ServerSignature Off' >> /etc/apache2/apache2.conf && \
    echo 'LogLevel crit' >> /etc/apache2/apache2.conf

# Configuramos Apache para que cumpla con las reglas de .htaccess y se aplique la estructura correcta
RUN a2enmod rewrite headers
COPY ./app/.htaccess /var/www/html/.htaccess
RUN service apache2 restart

RUN docker-php-ext-install mysqli