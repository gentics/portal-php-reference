# Gentics Portal | php - Reference

This repository contains both, an example docker compose stack for creating a new project with Gentics Portal | php, Gentics Mesh and Gentics CMS and an easy to start demo application showing the most important features of Gentics Portal | php |

## Requirements

- [GIT](https://git-scm.com/download/win)
- [Docker](https://docs.docker.com/install/) - Latest version
- [Docker Compose](https://docs.docker.com/compose/install/) - Latest version
- [PHP](http://php.net/downloads.php) - 8.3
- [Composer v2](https://getcomposer.org/doc/00-intro.md)

**Important: When using Windows, you must configure your GIT client to not convert line endings to windows line endings BEFORE cloning this GIT repository.**

```
git config --global core.autocrlf input
```

Read the section ["Installing the requirements"](#installing-the-requirements) for more specific details on how to install and configure the required tools.
If you encounter any errors, you maybe find a solution on [this page here](https://github.com/gentics/cms-compose/wiki/Common-problems-&-FAQ).

### Authentication for repo.gentics.com

Contact Gentics if you haven't received your credentials for repo.gentics,com yet.

Create the following files, with their respective content, to make the credentials available when building the container:

- `.docker/secrets/repo-user`
- `.docker/secrets/repo-pass`

Log in into the docker registry and use the same credentials:

```
docker login repo.gentics.com
```

## Setup

To build the portal, you first need to clone the `portal-php-laravel-project` to `portal`, with the appropriate branch:

```sh
git clone --branch hotfix-3.5.x git@git.gentics.com:psc/products/portal-php-laravel-project.git portal
```

After that, all you have to do is make your changes to the portal now, and build the container.

### Local Composer

If you need the dependencies locally for development, simply:

```sh
composer install -d portal
```

If authentication is required/requested, simply provide them in the CLI, which should store them locally.
In the case that this does not work, you may need to do it manually:

Open the composer file auth.json. You can also edit `%USERPROFILE%\AppData\Roaming\Composer\auth.json` or `~/.composer/auth.json` instead.

```bash
composer config --global --auth --editor
```

Make sure your auth.json contains the following configuration:

```
{
    "http-basic": {
        "repo.gentics.com": {
            "username": "MYUSERNAME",
            "password": "MYPASSWORD"
        }
    }
}
```

## Building

To build the container, all you have to do is run:

```sh
docker compose build portal
```

Any changes to the files which are required for the image will invalidate the cache appropriately.

## Running

For local setups, you should copy the example configurations:

- `docker-compose.override.yml` -> `docker-compose.override.yml`
- `portal/.env.example` -> `portal/.env`
  and adopt any changes you might need.

You will need to [create an API Token](https://www.gentics.com/mesh/docs/authentication/#_api_token) in Mesh in order for the portal to authenticate with it. After creating it, either add it to the `docker-compose.override.yml` or the `.env` file as `MESH_APIKEY` ENV-Variable.

Then simply run the whole stack with

```sh
docker compose up -d
```

### Services

The following Services are then available here:

- CMS: http://localhost:8080 - Default login: `node:node`
- Mesh: http://localhost:8100 - Default login: `admin:admin`
- Portal: http://localhost:8000

## Further Reading

- [mesh](https://getmesh.io/docs/beta/administration-guide.html#_environment_variables)
- [elasticsearch](https://www.elastic.co/guide/en/elasticsearch/reference/current/docker.html)
- [cms](https://hub.docker.com/r/gentics/cms/)
- [db](https://hub.docker.com/_/mariadb/)

## Howto

### Installing the requirements

#### GIT

##### Windows

Install the GIT client from https://git-scm.com/downloads

Make sure to enable "Checkout as-is, commit Unix-style" when the installer asks you.

##### Linux / Mac

Install the package "git" with the packet manager.

#### Docker

Minimum Hardware Requirements:

- CPU: x86, 2 cores
- Memory: 8 GB RAM
- Disk: 15 GB free space

#### Windows / Mac

- Use Docker with WSL2 if available
- We recommend to increase the memory to at least 6 GB and set the available CPU at least 2 cores in the Docker settings

#### PHP

Check if PHP 8.3 or higher is already installed by running `php -version`

If your operating system has a packet manager with PHP 8.3.7 or higher, install the package, otherwise download PHP from https://windows.php.net/download#php-8.3 (PHP 8.3 "VS16 x64 Non Thread Safe" for Windows).
