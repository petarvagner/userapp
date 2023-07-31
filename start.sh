#! /bin/bash
cd ./docker/

docker compose up -d

# wait for the containers to come up
until docker compose up -d; do
    echo "Waiting for containers..."
    sleep 0.5
done

docker compose run workspace composer install
docker compose run workspace cp -n .env.example .env
docker compose run workspace php artisan migrate
docker compose run workspace npm install
docker compose run workspace npm run build
