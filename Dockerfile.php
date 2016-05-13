FROM %DOCKER_REGISTRY%docker-library-alpine

MAINTAINER Serge Fomin <serge.fo@gmail.com>

RUN apk update \
  && apk add \
    php-fpm \
  && rm -rf /tmp/* /var/cache/apk/*

COPY etc/php/php-fpm.conf /etc/php/php-fpm.conf
VOLUME /var/run/php-fpm.sock

RUN mkdir /app

CMD php-fpm \
  -c /etc/php/php-fpm.conf \
  --allow-to-run-as-root
