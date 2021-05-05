#!/bin/bash


docker-compose up -d
sleep 5
docker-compose exec -u app app composer install
docker-compose exec -u app app php yii migrate --interactive=0

docker-compose down
