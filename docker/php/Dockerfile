FROM php:7.1-fpm

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

# Permission fix
RUN usermod -u 1000 www-data