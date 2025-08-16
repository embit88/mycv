#!/bin/sh
set -e
set -x

COMPOSE_FILE=docker-compose.prod.yml

echo "Останавливаем и удаляем контейнеры prod..."
sudo docker compose -f "$COMPOSE_FILE" down

echo "Собираем и запускаем prod контейнеры..."
sudo docker compose -f "$COMPOSE_FILE" up -d --build