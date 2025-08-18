#!/bin/sh
set -e
set -x

COMPOSE_FILE=docker-compose.prod.yml

echo "Останавливаем и удаляем контейнеры prod..."
docker compose -f "$COMPOSE_FILE" down

echo "Собираем и запускаем prod контейнеры..."
docker compose -f "$COMPOSE_FILE" up -d --build