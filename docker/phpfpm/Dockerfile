FROM php:7.0-fpm-alpine

#COPY /www /var/www/html

RUN curl -sS https://getcomposer.org/installer | \
  php -- --install-dir=/usr/local/bin --filename=composer

RUN rm -rf /var/www/html/logs/* \
    && chown -R www-data:www-data /var/www/html

