# GENTICS PORTAL | php - Reference

This repository contains both, an example docker compose stack for creating a new project with GENTICS PORTAL | php, Gentics Mesh and Gentics CMS and an easy to start demo application showing the most important features of GENTICS PORTAL | php

## Branches

| Branch     | Description       |
|------------|-------------------|
| newproject | For creating a fresh new project with GENTICS PORTAL  php |
| demo       | Demo reference application |

## Creating a new Laravel project with GENTICS PORTAL | php

This explains how to setup a basic Laravel project with the portal-php package.

### Prerequisites

* [docker](https://docs.docker.com/install/) - Latest version
* [docker-compose](https://docs.docker.com/compose/install/) - Latest version
* [composer](https://getcomposer.org/doc/00-intro.md) (Optional)

If you don't want to install composer locally, you can use it with Docker instead:

```bash
docker run --rm -ti -v `pwd`:/app composer composer <arguments>
```

You might have to replace `pwd` with `%cd%` in Windows shell.

### Create a new Laravel project

More information can be found on the Laravel documentation for the Installation.

Clone this GIT repository and change into the directory.

```bash
composer create-project --prefer-dist laravel/laravel portal
```

This will create a new directory called "portal". You can also name it differently, but then you have to change the path in the docker-compose configuration, entrypoint.sh and the apache2 vhost.

### Authentication for repo.apa-it.at

Contact Gentics if you haven't received your credentials for repo.apa-it.at yet.
It's also advised to use the encrypted password here, which can be generated in your Artifactory profile page. Replace &lt;YOURUSERNAME&gt; and &lt;YOURPASSWORD&gt; in the command below.

```bash
composer config --global --auth http-basic.repo.apa-it.at <YOURUSERNAME> <YOURPASSWORD>
```

### Install Gentics Portal | PHP

```bash
cd portal
composer config repositories.gentics composer "https://repo.apa-it.at/api/composer/php"
composer require gentics/portal-php:^0.2.0
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
RewriteCond %{REQUEST_METHOD}  =GET
```


### Docker service configuration

Copy the file `docker-compose.override.yml.example` to `docker-compose.override.yml`
You can configure passwords, ports, environment variables and other settings `in docker-compose.override.yml`
The license key for the cms has to be changed.

Service documentation:

* [mesh](https://getmesh.io/docs/beta/administration-guide.html#_environment_variables)
* [elasticsearch](https://www.elastic.co/guide/en/elasticsearch/reference/current/docker.html)
* [cms](https://hub.docker.com/r/gentics/cms/)
* [db](https://hub.docker.com/_/mariadb/)

### Run the portal

```bash
docker-compose up -d
```

This will build the portal docker image and run the docker service.

### Open the reference project in the browser

http://localhost:8080


## Howto

### Building the Dockerfile

If you do any changes do the Dockerfile, you have to run

```bash
docker-compose build
```

### Custom error pages

In order to use custom error pages (404, 500), you have to extend your Exception handler from the class `\Gentics\PortalPhp\Exceptions\Handler`.

Open `portal/app/Exceptions/Handler.php` and replace the following line:

```php
class Handler extends ExceptionHandler
```

with this:

```php
class Handler extends \Gentics\PortalPhp\Exceptions\Handler
```
