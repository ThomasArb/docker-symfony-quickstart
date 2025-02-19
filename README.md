
# How to

## Install

Before starting the project, you need to set three env variable (in a `.env` file for example) :
* VALIDATOR_URI : url of the api to validate phone numbers
* VALIDATOR_LOGIN : username for the api
* VALIDATOR_PASSWORD : password for the api

```bash
docker-compose -f etc/docker/docker-compose.yml up -d 
docker exec -ti docker_app_1 bash -c "cd app && composer install"
docker exec -ti docker_app_1 bash -c "cd app && php bin/console doctrine:migration:migrate && php bin/console cache:clear --env=prod && php bin/console cache:clear --env=dev"
```

Open [http://localhost:8000](http://localhost:8000)

-----

## Clear symfony cache

```bash
docker exec -ti docker_app_1 bash -c "cd app && php bin/console cache:clear --env=prod && php bin/console cache:clear --env=dev"
```

-----

## Run symfony console commands

```bash
docker exec -ti docker_app_1 bash
cd app
php bin/console *******
```

-----

## See logs

```bash
docker logs -f docker_app_1 
```

-----

## Find docker container name

If `docker_app_1` dosen't exist find the good symfony container name with `docker ps`

```bash
docker ps
```

-----

# Endpoints

- Symfony: http://localhost:8000
- MariaDB: mysql://${MARIADB_USER}:${MARIADB_PASSWORD}@${MARIADB_HOST}:${MARIADB_PORT_NUMBER}/${MARIADB_DATABASE}?serverVersion=5.7

See the `/etc/docker/docker-compose.yml` file to see/change the endpoints

-----

# ressources

## Docker images

- bitnami/symfony:1
- bitnami/mariadb:10.3

## Symfony

- [https://symfony.com/doc/current/index.html](https://symfony.com/doc/current/index.html)
