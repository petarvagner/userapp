#! /bin/bash
cd ./docker/

docker compose up -d && \
docker compose run workspace composer install && \
docker compose run workspace cp -n .env.example .env && \
docker compose run workspace php artisan migrate && \
docker compose run workspace npm install && \
docker compose run workspace npm run build
