FROM php:fpm

RUN apt-get update && apt-get install -y libpq-dev

RUN docker-php-ext-install pdo_mysql pdo_pgsql

# RUN a2enmod vhost_alias

# COPY ./000-default.conf /etc/apache2/sites-available/

# RUN a2ensite 000-default
