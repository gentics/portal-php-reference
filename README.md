# GENTICS PORTAL | php - Reference

This repository contains both, an example docker compose stack for creating a new project with GENTICS PORTAL | php, Gentics Mesh and Gentics CMS and an easy to start demo application showing the most important features of GENTICS PORTAL | php

## Branches

| Branch     | Description       |  Documentation |
|------------|-------------------| ---------------|
| newproject | For creating a fresh new project with GENTICS PORTAL  php | [Link](#creating-a-new-laravel-project-with-gentics-portal--php) |
| demo       | Demo reference application | [Link](README.demo.md) |

## Requirements

* [GIT](https://git-scm.com/download/linux)
* [Docker](https://docs.docker.com/install/) - Latest version
* [Docker-compose](https://docs.docker.com/compose/install/) - Latest version
* [PHP](http://php.net/downloads.php) - Any version >= 7.1.3
* [Composer](https://getcomposer.org/doc/00-intro.md)

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

## Creating a new Laravel project with GENTICS PORTAL | php

This explains how to setup a basic Laravel project with the portal-php package.

### Create a new Laravel project

More information can be found on the Laravel documentation for the Installation.

Clone this GIT repository and change into the directory.

```bash
composer create-project --prefer-dist laravel/laravel:^6 portal
```

This will create a new directory called "portal". You can also name it differently, but then you have to change the path in the docker-compose configuration, entrypoint.sh and the apache2 vhost.

### Install Gentics Portal | PHP

```bash
cd portal
composer config repositories.gentics composer "https://repo.apa-it.at/api/composer/php"
composer require gentics/portal-php:^1.2.0 --ignore-platform-reqs
php artisan vendor:publish --provider="Gentics\PortalPhp\Providers\ServiceProvider"
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

#### Windows / Mac ####

* Use Docker with HyperV if avilable
* We recommend to increase the memory to at least 4 GB or better 6GB and set the available CPU to all CPU cores in the Docker settings

#### PHP

Check if PHP 7.1.3 or higher is already installed by running `php -version`

If your operating system has a packet manager with PHP 7.1.3 or higher, install the package, otherwise download PHP from http://at2.php.net/downloads.php (PHP 7.3 "VC15 x64 Non Thread Safe" for Windows).

### Building the Dockerfile

If you do any changes do the Dockerfile or files in `portal-files`, you have to run

```bash
docker-compose build
```