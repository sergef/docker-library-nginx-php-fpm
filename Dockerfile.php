FROM %DOCKER_REGISTRY%docker-library-alpine

MAINTAINER Serge Fomin <serge.fo@gmail.com>

RUN apk update \
  && apk add \
    php-fpm \
    php-json \
    php-zlib \
    php-xml \
    php-pdo \
    php-phar \
    php-openssl \
    php-pdo_mysql \
    php-mysqli \
    php-gd \
    php-iconv \
    php-mcrypt \
    php-mysql \
    php-curl \
    php-opcache \
    php-ctype \
    php-apcu \
    php-intl \
    php-bcmath \
    php-dom \
    php-xmlreader \
    mysql-client \
  && rm -rf /tmp/* /var/cache/apk/*

COPY etc/php/php-fpm.conf /etc/php/php-fpm.conf
# VOLUME /var/run/php-fpm.sock

RUN mkdir /app

CMD php-fpm \
  -c /etc/php/php-fpm.conf \
  --nodaemonize \
  --allow-to-run-as-root
