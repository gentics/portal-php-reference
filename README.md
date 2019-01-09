# GENTICS PORTAL | php - Reference implementation

This repository contains an example docker compose stack for GENTICS PORTAL | php with Gentics Mesh and Gentics CMS.

## Run reference Laravel project implementation with GENTICS PORTAL | php

### Authentication for repo.apa-it.at

Contact Gentics if you haven't received your credentials for repo.apa-it.at yet.
It's also advised to use the encrypted password here, which can be generated in your Artifactory profile page. Replace &lt;YOURUSERNAME&gt; and &lt;YOURPASSWORD&gt; in the command below.

```bash
composer config --global --auth http-basic.repo.apa-it.at <YOURUSERNAME> <YOURPASSWORD>
```

### Install portal composer dependencies

```bash
cd portal
composer install --ignore-platform-reqs
cd ..
```

### Docker service configuration

#### Copy `docker-compose.override.yml.example` to `docker-compose.override.yml`

You can configure passwords, ports, environment variables and other settings in `docker-compose.override.yml`
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
* Log in to http://localhost:8082 with `node`/`node` and wait until the publish run has finished and has published all objects into Mesh.

### Open the reference project in the browser

* http://localhost:8080
* on first use, register yourself a new user

## Next Steps

1. Visit the "Automobiles" Section of the [portal](http://localhost:8080), check out the different cars and their metadata
2. For one of the cars, find the corresponding page in the [Mesh-UI](http://localhost:8081/)
3. Keep going by finding the corresponding page in the [Gentics CMS](http://localhost:8080/). Notice that in the CMS preview of the page, the navigation and breadcrumbs are not consistent with the portal, whereas the content of the page is rendered identically.
4. Using the WYSIWYG editor, modify the price, and expand the description of the car with some HTML elements.
5. Notice that saving the page does not have an effect on the portal. After publishing, the content in the portal is updated.
6. Find out which CMS template is used for cars, and what the template name is. Look up that template in your IDE, make a change. Notice that saved changes are immediately available in the portal.
