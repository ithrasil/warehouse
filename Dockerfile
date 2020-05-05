FROM php:7.4-apache

RUN a2enmod rewrite

RUN apt-get update \
    && apt-get install -y libxml2-dev cron libcurl4-gnutls-dev libicu-dev git libxrender1 libfontconfig1 libxext6 zlib1g-dev libzip-dev libz-dev libpng-dev libjpeg62-turbo-dev nano gnupg \

    && rm -rf /var/lib/apt/lists/*r

RUN apt-get install -y libpq-dev


RUN pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini

RUN docker-php-ext-install intl opcache zip dom curl exif mysqli pdo pdo_mysql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

ADD docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
ADD docker/php.ini /usr/local/etc/php/php.ini
ADD docker/entrypoint.sh /usr/local/bin/

ADD . /var/www
WORKDIR /var/www

ENTRYPOINT ["entrypoint.sh"]

CMD ["apache2-foreground"]

