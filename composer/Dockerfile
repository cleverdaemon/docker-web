FROM php:fpm-alpine

#RUN apt update && apt add git

# RUN docker-php-ext-install pdo_mysql pdo_pgsql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php --install-dir=/usr/local/bin --filename=composer && php -r "unlink('composer-setup.php');"

# RUN a2enmod vhost_alias

# COPY ./000-default.conf /etc/apache2/sites-available/

# RUN a2ensite 000-default
