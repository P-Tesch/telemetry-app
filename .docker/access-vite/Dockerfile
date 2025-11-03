FROM node:24-alpine AS base

FROM base AS development

USER root

RUN apk update && apk add --no-cache \
    php84 \
    php84-cli \
    php84-phar \
    php84-openssl \
    php84-json \
    php84-mbstring \
    php84-tokenizer \
    php84-xml \
    php84-curl \
    php84-dom \
    php84-zip \
    php84-session \
    php84-fileinfo

RUN ln -sf /usr/bin/php84 /usr/bin/php

CMD ["sh", "-c", "npm install && npm run dev"]