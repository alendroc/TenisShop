#!/bin/sh
set -e

# ── Generar .env desde variables de entorno de Render ──────────────
echo ">>> Generando .env..."
cat > /var/www/html/.env <<EOF
APP_NAME="${APP_NAME:-TenisShop}"
APP_ENV="${APP_ENV:-production}"
APP_KEY="${APP_KEY:-}"
APP_DEBUG="${APP_DEBUG:-true}"
APP_URL="${APP_URL:-https://tenisshop-production.up.railway.app/}"

LOG_CHANNEL=stderr
LOG_LEVEL=error

DB_CONNECTION=sqlite
DB_DATABASE="${DB_DATABASE:-/var/data/database.sqlite}"

SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_STORE=file
QUEUE_CONNECTION=sync
EOF

# ── Base de datos SQLite ────────────────────────────────────────────
DB_PATH="${DB_DATABASE:-/var/data/database.sqlite}"
DB_DIR=$(dirname "$DB_PATH")

echo ">>> Verificando directorio de base de datos: $DB_DIR"
mkdir -p "$DB_DIR"

echo ">>> Creando archivo SQLite si no existe..."
touch "$DB_PATH"
chown -R www-data:www-data "$DB_DIR"
chmod -R 775 "$DB_DIR"
chmod 664 "$DB_PATH"

echo ">>> Regenerando autoload..."
composer dump-autoload --optimize --no-interaction   # ← línea nueva

echo ">>> Generando APP_KEY..."
php artisan key:generate --force

echo ">>> Corriendo migraciones..."
php artisan migrate --force

echo ">>> Corriendo seeders solo si la BD está vacía..."
TABLA=$(php artisan tinker --execute="echo \App\Models\Zapato::count();" 2>/dev/null || echo "0")
if [ "$TABLA" = "0" ]; then
  echo ">>> BD vacía, corriendo seeders..."
  php artisan db:seed --force
fi

echo ">>> Cacheando configuración..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link

echo ">>> Iniciando Supervisor (Nginx + PHP-FPM)..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf