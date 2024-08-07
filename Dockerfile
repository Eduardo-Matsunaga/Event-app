FROM php:8.3-alpine

ENV TIMEZONE America/Sao_Paulo

#COPY php-ini-docker.ini "${PHP_INI_DIR}/php.ini"

RUN  apk update; \
     apk add bash; \
     apk add curl; \
     curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
     alias composer='/composer.phar'; \
     apk add --no-cache zip libzip-dev; \
     apk add --no-cache icu-dev; \
     docker-php-ext-configure zip; \
     docker-php-ext-install zip; \
     docker-php-ext-install pdo; pdo_mysql; \
     docker-php-ext-install pdo_mysql;  \
     docker-php-ext-configure intl;  \
     docker-php-ext-install intl;  \
     apk add --no-cache $PHPIZE_DEPS; \
     apk add --update linux-headers; \
     apk add git; \
     mkdir -p /usr/src/event-app/storage /usr/src/event-app/bootstrap/cache && \
         chown -R www-data:www-data /usr/src/event-app/storage /usr/src/event-app/bootstrap/cache && \
         chmod -R 755 /usr/src/event-app/storage /usr/src/event-app/bootstrap/cache


