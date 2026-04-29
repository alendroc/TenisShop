# ─────────────────────────────────────────────────────────────────
# Dockerfile — TenisShop (Render + SQLite)
# Stack: Laravel 11 · PHP 8.2 · SQLite · Vite · Node 20
# ─────────────────────────────────────────────────────────────────

# ── Etapa 1: Build de assets con Node/Vite ────────────────────────
FROM node:20-alpine AS node-builder

WORKDIR /app

COPY TeniShop/package.json TeniShop/package-lock.json* ./
RUN npm install

COPY TeniShop/vite.config.js ./
COPY TeniShop/resources/ ./resources/

RUN npm run build

# ── Etapa 2: Imagen de producción con PHP + Laravel ───────────────
FROM php:8.2-fpm-alpine AS app

LABEL maintainer="TenisShop" \
      description="TenisShop — Laravel 11 + PHP 8.2 + SQLite (Render)"

RUN apk add --no-cache \
        libpng-dev \
        libzip-dev \
        oniguruma-dev \
        sqlite \
        sqlite-dev \
        curl \
        nginx \
        supervisor \
    && docker-php-ext-install \
        pdo \
        pdo_sqlite \
        mbstring \
        zip \
        gd \
        bcmath \
        opcache

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Dependencias PHP primero (caché de Docker)
COPY TeniShop/composer.json TeniShop/composer.lock ./
RUN composer install \
        --no-dev \
        --no-interaction \
        --no-scripts \
        --optimize-autoloader \
        --prefer-dist

# Código fuente
COPY TeniShop/ .

# Assets compilados desde etapa Node
COPY --from=node-builder /app/public/build ./public/build

# Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Configuraciones
COPY TeniShop/docker/nginx.conf       /etc/nginx/http.d/default.conf
COPY TeniShop/docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY TeniShop/docker/php-opcache.ini  /usr/local/etc/php/conf.d/opcache.ini

# Script de inicio
COPY TeniShop/docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=60s --retries=3 \
    CMD curl -fsSL http://localhost/up || exit 1

CMD ["/usr/local/bin/start.sh"]