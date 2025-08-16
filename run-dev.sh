#!/bin/sh
set -e
set -x

COMPOSE_FILE=docker-compose.dev.yml

echo "Останавливаем и удаляем контейнеры dev..."
sudo docker compose -f "$COMPOSE_FILE" down

echo "Собираем и запускаем dev контейнеры..."
sudo docker compose -f "$COMPOSE_FILE" up -d --build