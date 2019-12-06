FROM php:7.3-fpm-alpine

RUN apk --update --repository http://dl-cdn.alpinelinux.org/alpine/edge/community/ add \
            git \
            unzip \
            zip \
            zlib-dev \
            nano \
            autoconf \
            gcc \
            make \
            g++ \
            shadow \
            openssl \
            tzdata \
            gnu-libiconv \
            postgresql-dev \
            libzip-dev \
    && NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install -j${NPROC} pdo_pgsql pgsql zip pcntl mbstring bcmath \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-install opcache \
    && pecl install xdebug-2.8.0 \
    && apk del autoconf g++ make zlib-dev gcc autoconf libgcc \
    && rm -rf /var/cache/apk/*

RUN groupadd -r web \
    && useradd -u 1000 -l -r -m -g web web \
    && mkdir /app \
    && chown web:web /app

ENV SUPERCRONIC_URL=https://github.com/aptible/supercronic/releases/download/v0.1.9/supercronic-linux-amd64 \
    SUPERCRONIC=supercronic-linux-amd64 \
    SUPERCRONIC_SHA1SUM=5ddf8ea26b56d4a7ff6faecdd8966610d5cb9d85

RUN curl -fsSLO "$SUPERCRONIC_URL" \
    && echo "${SUPERCRONIC_SHA1SUM}  ${SUPERCRONIC}" | sha1sum -c - \
    && chmod +x "$SUPERCRONIC" \
    && mv "$SUPERCRONIC" "/usr/local/bin/${SUPERCRONIC}" \
    && ln -s "/usr/local/bin/${SUPERCRONIC}" /usr/local/bin/supercronic


ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz

COPY --from=composer:1.9 /usr/bin/composer /usr/bin/composer
COPY /application/docker/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ENV COMPOSER_CACHE_DIR=/dev/null

COPY application/docker/artisan-cron /etc/cron.d/artisan-cron

COPY --chown=web:web application/docker/dockerize.sh /usr/local/bin/
RUN ln -s /usr/local/bin/dockerize.sh /
ENTRYPOINT ["dockerize.sh"]

USER web

WORKDIR /app

COPY --chown=web:web application/composer.json /app/composer.json
COPY --chown=web:web application/composer.lock /app/composer.lock

ARG env

COPY --chown=web:web . /app





