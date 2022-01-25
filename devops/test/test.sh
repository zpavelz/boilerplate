#!/usr/bin/env sh

set -exo

COMPOSE_FILE="devops/test/docker-compose-tests.yml"

docker_compose_cleanup() {
    docker-compose -f $COMPOSE_FILE down --remove-orphans
}

trap docker_compose_cleanup EXIT

docker-compose -f $COMPOSE_FILE up --build -d --remove-orphans
docker exec -it test-boilerplate-php composer psalm
docker exec -it test-boilerplate-php composer tests
