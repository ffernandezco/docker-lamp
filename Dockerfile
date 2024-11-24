FROM php:7.3-apache

RUN echo 'ServerTokens Prod' >> /etc/apache2/apache2.conf && \
    echo 'ServerSignature Off' >> /etc/apache2/apache2.conf && \
    echo 'LogLevel crit' >> /etc/apache2/apache2.conf && \
    echo 'Header always edit Set-Cookie (.*) "$1; SameSite=Strict"' >> /etc/apache2/apache2.conf

# Configuramos Apache para que cumpla con las reglas de .htaccess y se aplique la estructura correcta
RUN a2enmod rewrite headers
COPY ./app/.htaccess /var/www/html/.htaccess
RUN service apache2 restart

# Configuración PHP
RUN echo 'session.cookie_httponly=1' >> /usr/local/etc/php/conf.d/session.ini && \
    echo 'session.cookie_secure=1' >> /usr/local/etc/php/conf.d/session.ini && \
    echo 'session.cookie_samesite=Strict' >> /usr/local/etc/php/conf.d/session.ini

RUN docker-php-ext-install mysqli