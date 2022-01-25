# Symfony boilerplate

## Requirements no docker
### symfony cli
### php 8.1
### composer v2.2
## Requirements with docker 
### docker && docker-compose v3

## Local usage
    1. Clone project
    2. Run docker-compose up --build -d
    3. Run `docker exec -it boilerplate-php composer install`
    4. Open `http://127.0.0.1:8000`

## Tips
    1. use docker-compose.override.yml to change any parameters

## Tests
    ./devops/test/test.sh