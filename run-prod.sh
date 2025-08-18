#!/bin/bash
set -e
set -x

COMPOSE_FILE=docker-compose.prod.yml
DEPLOY_PATH=/var/www/vhosts/mymein.com/httpdocs

echo "Останавливаем и удаляем контейнеры prod..."
docker compose -f "$COMPOSE_FILE" down

echo "Очищаем старые файлы на сервере (кроме .git если нужен)..."
rm -rf $DEPLOY_PATH/!(.git)

echo "Собираем и запускаем prod контейнеры..."
docker compose -f "$COMPOSE_FILE" up -d --build
