#FROM php:8.0-apache AS build-php
FROM wordpress:latest

# Initial workspace config
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
    chmod +x wp-cli.phar && \
    mv wp-cli.phar /usr/local/bin/wp && \
    adduser --disabled-password --disabled-login --no-create-home wp-user && \
    chown -R wp-user:wp-user /var/www/html/wp-content

# Project setup
WORKDIR /var/www/html/wp-content/plugins/cobolt-suite

COPY ./composer.json ./composer.json

RUN composer install --no-dev --prefer-dist

VOLUME /var/www/html
VOLUME /var/www/html/wp-content/plugins/cobolt-suite

USER wp-user

# Use WP Default Entrypoint
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]