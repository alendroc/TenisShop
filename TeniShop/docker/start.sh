#!/bin/sh
set -e

DB_PATH="${DB_DATABASE:-/var/data/database.sqlite}"
DB_DIR=$(dirname "$DB_PATH")

echo ">>> Verificando directorio de base de datos: $DB_DIR"
mkdir -p "$DB_DIR"

echo ">>> Creando archivo SQLite si no existe..."
touch "$DB_PATH"
chown -R www-data:www-data "$DB_DIR"
chmod -R 775 "$DB_DIR"
chmod 664 "$DB_PATH"

echo ">>> Generando APP_KEY si no existe..."
php artisan key:generate --force

echo ">>> Corriendo migraciones..."
php artisan migrate:fresh --force

echo ">>> Corriendo seeders..."
php artisan db:seed --force

echo ">>> Limpiando y cacheando configuración..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link

echo ">>> Iniciando Supervisor (Nginx + PHP-FPM)..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf