#!/bin/bash

docker exec -it -w "/app" "esoternet_app-web-1" bash -c 'php bin/console doctrine:schema:update --dump-sql'
echo "Procéder ? (o/n)"
read -n 1 proceed
proceed_lower=$(echo "$proceed" | tr '[:upper:]' '[:lower:]')

if [ "$proceed" = "o" ] ; then
    docker exec -it -w "/app" "esoternet_app-web-1" bash -c 'php bin/console doctrine:schema:update --force'
    docker exec -it -w "/app" "esoternet_app-web-1" bash -c 'php bin/console make:migration'
    docker exec -it -w "/app" "esoternet_app-web-1" bash -c 'php bin/console doctrine:migration:migrate'
    docker exec -it -w "/app" "esoternet_app-web-1" bash -c 'php bin/console doctrine:schema:update --force'
    docker exec -it -w "/app" "esoternet_app-web-1" bash -c 'php bin/console doctrine:schema:validate'
fi