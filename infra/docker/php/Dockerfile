# /srv/dev-disk-by-uuid-5f656e1d-a107-4bc4-8c71-f72f6511769d/CodigoFonte/producao/admisao_cdc/infra/docker/php/Dockerfile

FROM php:8.3-fpm-bullseye AS base

WORKDIR /workspace

# Configura variáveis de ambiente
ENV TZ=America/Sao_Paulo \
    LANG=pt_BR.UTF-8 \
    LANGUAGE=pt_BR:pt \
    LC_ALL=pt_BR.UTF-8 \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer \
    DEBIAN_FRONTEND=noninteractive

# Argumentos para UID e GID
ARG UID=1000
ARG GID=1000

# Instala dependências do sistema e extensões PHP em uma única camada otimizada
# hadolint ignore=DL3008
RUN set -eux && \
    apt-get update && \
    apt-get -y install --no-install-recommends \
    locales \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    default-mysql-client \
    ca-certificates \
    curl && \
    # Configura locales
    echo "pt_BR.UTF-8 UTF-8" >> /etc/locale.gen && \
    echo "en_US.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen && \
    # Instala extensões PHP
    docker-php-ext-configure intl && \
    docker-php-ext-install -j$(nproc) \
    intl \
    pdo_mysql \
    zip \
    bcmath \
    opcache && \
    # Limpa cache do apt
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Copia Composer de forma mais eficiente
COPY --from=composer:2.8.4 /usr/bin/composer /usr/bin/composer

# Copia Node.js
COPY --from=node:lts-buster-slim /usr/local/bin /usr/local/bin
COPY --from=node:lts-buster-slim /usr/local/lib /usr/local/lib
COPY --from=node:lts-buster-slim /opt /opt

# Criar grupo e usuário phper, diretórios necessários
RUN set -eux && \
    groupadd --gid $GID phper || true && \
    useradd --uid $UID --gid $GID --create-home --shell /bin/bash phper || true && \
    mkdir -p /composer /home/phper/.config/psysh && \
    chown -R phper:phper /composer /workspace /home/phper/.config/psysh 2>/dev/null || true

# Stage de desenvolvimento
FROM base AS development

# Copia configuração PHP para desenvolvimento
COPY ./infra/docker/php/php.development.ini /usr/local/etc/php/php.ini

# Configura OPcache para desenvolvimento
RUN echo "opcache.enable=0" >> /usr/local/etc/php/conf.d/opcache.ini

USER phper

# Stage de desenvolvimento com Xdebug
FROM base AS development-xdebug

# Instala Xdebug
RUN set -eux && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug

# Copia configurações
COPY ./infra/docker/php/php.development.ini /usr/local/etc/php/php.ini
COPY ./infra/docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Desabilita OPcache para desenvolvimento com Xdebug
RUN echo "opcache.enable=0" >> /usr/local/etc/php/conf.d/opcache.ini

USER phper

# Stage de produção
FROM base AS deploy

# Copia configuração PHP para produção
COPY ./infra/docker/php/php.deploy.ini /usr/local/etc/php/php.ini

# Configura OPcache para produção
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.interned_strings_buffer=16" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.max_accelerated_files=20000" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.save_comments=0" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini

# Copia apenas os arquivos necessários para produção
COPY --chown=phper:phper composer.json composer.lock ./
COPY --chown=phper:phper artisan ./

# Instala dependências do Composer primeiro (melhor cache)
USER phper
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --quiet

# Copia o código fonte
COPY --chown=phper:phper ./src ./

# Finaliza instalação e otimizações
RUN set -eux && \
    composer dump-autoload --optimize --no-dev && \
    # Cria diretórios necessários se não existirem
    mkdir -p storage/logs storage/framework/{cache,sessions,views} bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache && \
    # Otimizações do Laravel
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Healthcheck para monitoramento
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD php-fpm -t || exit 1