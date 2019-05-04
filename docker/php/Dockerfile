FROM php:7.2-fpm

# Install recommended extensions for Symfony
RUN apt-get update && apt-get install -y \
        libicu-dev \
        git \
    && docker-php-ext-install \
        intl \
        opcache \
        pdo_mysql \
    && docker-php-ext-enable \
        intl \
        pdo_mysql \
    && curl -s https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

RUN pecl install xdebug-2.6.0RC2
RUN docker-php-ext-enable xdebug
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini

# Permission fix
RUN usermod -u 1000 www-data