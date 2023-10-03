# Gentics Portal | php - Reference

This repository contains both, an example docker compose stack for creating a new project with Gentics Portal | php, Gentics Mesh and Gentics CMS and an easy to start demo application showing the most important features of Gentics Portal | php

## Branches

| Branch     | Description       |  Documentation |
|------------|-------------------| ---------------|
| newproject | For creating a fresh new project with Gentics Portal php | [Link](#creating-a-new-laravel-project-with-gentics-portal--php) |
| demo       | Demo reference application | [Link](README.demo.md) |

## Requirements

* [GIT](https://git-scm.com/download/win)
* [Docker](https://docs.docker.com/install/) - Latest version
* [Docker Compose](https://docs.docker.com/compose/install/) - Latest version
* [PHP](http://php.net/downloads.php) - 8.1 (>=8.1.7)
* [Composer v2](https://getcomposer.org/doc/00-intro.md)

**Important: When using Windows, you must configure your GIT client to not convert line endings to windows line endings BEFORE cloning this GIT repository.**

```
git config --global core.autocrlf input
```

Read the section ["Installing the requirements"](#installing-the-requirements) for more specific details on how to install and configure the required tools.
If you encounter any errors, you maybe find a solution on [this page here](https://github.com/gentics/cms-compose/wiki/Common-problems-&-FAQ).

### Authentication for repo.apa-it.at

Contact Gentics if you haven't received your credentials for repo.apa-it.at yet.

Open the composer file auth.json. You can also edit `%USERPROFILE%\AppData\Roaming\Composer\auth.json` or `~/.composer/auth.json` instead.

```bash
composer config --global --auth --editor
```

Make sure your auth.json contains the following configuration:

```
{
    "http-basic": {
        "repo.apa-it.at": {
            "username": "MYUSERNAME",
            "password": "MYPASSWORD"
        }
    }
}
```

Replace `MYUSERNAME` and `MYPASSWORD`. Use the API key as password, which can be generated/retrieved in the Artifactory profile page.

Log in into the docker registry and use the same credentials like above:

```
docker login repo.apa-it.at
```

## Running the demo

See: https://github.com/gentics/portal-php-reference/blob/demo/README.demo.md

## Creating a new Laravel project with Gentics Portal | php

This explains how to setup a basic Laravel project with the portal-php package.

### Create a new Laravel project with Gentics Portal | php

```bash
composer create-project gentics/portal-php-laravel-project portal --repository-url "https://repo.apa-it.at/api/composer/php"
```

This adds the repository "gentics" to your projects composer.json, pulls the dependencies and copies some default files from the portal-php package.

### .htaccess

POST requests from the CMS to the CmsController do not work by default because the stock Laravel .htaccess redirects all requests that have a trailing slash in order to remove it.
However due do the RFC standard which disallows POST redirects without user interaction, this means that the POST data is lost.

We can fix this easily, in `portal/public/.htaccess` find this line (line 12):

```apache
# Redirect Trailing Slashes If Not A Folder...
```

Add this after:

```apache
RewriteCond %{REQUEST_METHOD} =GET
```

### Docker service configuration

Copy the file `docker-compose.override.yml.example` to `docker-compose.override.yml`
You can configure passwords, ports, environment variables and other settings `in docker-compose.override.yml`
The license key for the cms has to be changed.

### Running the portal

#### Copy `docker-compose.override.yml.example` to `docker-compose.override.yml`

You can configure passwords, ports, environment variables and other settings `in docker-compose.override.yml`
The license key for the cms has to be changed.

#### Copy `portal/.env.example` to `portal/.env`

This file contains the environment settings for the Laravel framework.

Run:

```bash
docker-compose up -d
```

* You can view the container status with `docker-compose ps`
* To view the logs of a specific container, use `docker-compose logs -f name`. e.g.: `docker-compose logs -f portal`
* You can read [this page here](https://github.com/gentics/cms-compose/wiki/Common-problems-&-FAQ) if you encounter any problems.

#### Disable automatic Mesh API Key generation

Set `AUTOGENERATE_MESH_API_KEY` environment variable to false for the portal.

#### Open the reference project in the browser

##### Portal application

http://localhost:8080 - If asked for authentication, register a new account (Keycloak)

##### Mesh

http://localhost:8081 - Use admin admin as login

##### CMS

http://localhost:8082 - Use node node as login

## Service documentation:

* [mesh](https://getmesh.io/docs/beta/administration-guide.html#_environment_variables)
* [elasticsearch](https://www.elastic.co/guide/en/elasticsearch/reference/current/docker.html)
* [cms](https://hub.docker.com/r/gentics/cms/)
* [db](https://hub.docker.com/_/mariadb/)

## Howto

### Installing the requirements

#### GIT

##### Windows

Install the GIT client from https://git-scm.com/downloads

Make sure to enable "Checkout as-is, commit Unix-style" when the installer asks you.

##### Linux / Mac ####

Install the package "git" with the packet manager.

#### Docker

Minimum Hardware Requirements:
- CPU: x86, 2 cores
- Memory: 8 GB RAM
- Disk: 15 GB free space

#### Windows / Mac ####

* Use Docker with WSL2 if available
* We recommend to increase the memory to at least 6 GB and set the available CPU at least 2 cores in the Docker settings

#### PHP

Check if PHP 8.1.7 or higher is already installed by running `php -version`

If your operating system has a packet manager with PHP 8.1.7 or higher, install the package, otherwise download PHP from https://windows.php.net/download#php-8.1 (PHP 8.1 "VS16 x64 Non Thread Safe" for Windows).

### Building the Dockerfile

If you do any changes do the Dockerfile or files in `portal-files`, you have to run

```bash
docker-compose build
```