# GENTICS PORTAL | php - Demo

## Run the GENTICS PORTAL | php demo

Read the section "[Installing requirements](README.md#requirements)" first and make sure you have installed and configured everything correctly.

### Install portal composer dependencies

```bash
cd portal
composer install --ignore-platform-reqs
cd ..
```

### Docker service configuration

#### Copy `docker-compose.override.yml.example` to `docker-compose.override.yml`

You can configure passwords, ports, environment variables and other settings `in docker-compose.override.yml`
The license key for the cms has to be changed.

#### Copy `portal/.env.example` to `portal/.env`

This file contains the environment settings for the Laravel framework.


#### Service documentation

* [mesh](https://getmesh.io/docs/beta/administration-guide.html#_environment_variables)
* [elasticsearch](https://www.elastic.co/guide/en/elasticsearch/reference/current/docker.html)
* [cms](https://hub.docker.com/r/gentics/cms/)
* [db](https://hub.docker.com/_/mariadb/)

### Run the portal

```bash
docker login docker.apa-it.at
docker-compose up -d
```

This will build the portal docker image and run the docker service

### Wait for docker container initialization and the CMS publish run to be complete

* You can view the container status with `docker-compose ps`
* To view the logs of a specific container, use `docker-compose logs -f name`. e.g.: `docker-compose logs -f portal`
* Log in to http://localhost:8082 with `node` `node` and wait until the publish run has finished and has published all objects into Mesh.

### Open the reference project in the browser

* http://localhost:8080
