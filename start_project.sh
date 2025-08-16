#!/bin/sh
set -e
set -x

echo "Stopping and removing containers."
sudo docker compose down

echo "Starting containers."
sudo docker compose up -d --build

