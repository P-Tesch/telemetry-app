############################################
# Base Image
############################################
FROM php:8.4-fpm-alpine AS base

############################################
# Development Image
############################################
FROM base AS development

USER root

RUN apk update

# Install PHP extensions
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS imagemagick-dev icu-dev openssl-dev \
    && docker-php-ext-install intl bcmath \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && apk del .build-deps \
    && rm -rf /tmp/pear

# Install Node.js
RUN apk add nodejs-lts npm

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# This is needed to fix Composer warnings during installations/updates
RUN mkdir -p /composer/cache/files && \
    chown -R www-data:www-data /composer

ARG USER_ID
ARG GROUP_ID

RUN addgroup -g $GROUP_ID www-data && adduser -D -u $USER_ID -G www-data www-data || true

USER www-data
