#!/bin/bash

docker exec -it -w "/app" "esoternet_app-web-1" bash -c 'php bin/console doctrine:database:drop --force'
docker exec -it -w "/app" "esoternet_app-web-1" bash -c 'php bin/console doctrine:database:create'