# Gentics Portal | php - Reference Demo

## Run the Gentics Portal | php - Reference Demo

Read the section "[Installing requirements](README.md#requirements)" first and make sure you have installed and configured everything correctly.

### Install portal composer dependencies

```bash
cd portal
composer install
cd ..
```

### Running the portal

Read the section ["Running the portal" in the README](README.md#running-the-portal).

#### Required plugins for some demos

##### Search plugin
This plugin is required for the Search functionality as the portal calls the Search plugin endpoints to get the results.

##### Reference Authentication plugin
This plugin is required if you would like to map roles and groups to your users, but without that, the Authentication can be tested with Keycloak if you enable authentication.

##### Likes plugin
This plugin is required to show-case the likes feature on the vehicle page.

### Wait for the CMS publish run to be complete

* Log in to http://localhost:8082 with `node` `node` and wait until the publish run has finished and has published all objects into Mesh. You can also republish all objects in the Maintenance page, if the publish doesn't work.

### Changing the assets

We are using CSS and JavaScript pre-processor to generate the Gentics Portal | php reference assets, and its already
ships with pre-built assets, but changes in these files will be lost on next build.

Laravel Mix is used to generate the assets inside the **./portal/public/static/demo-assets/files/** folder, and the
source files are in the **./portal/resources/assets/** folder. See [webpack.mix.js](portal/webpack.mix.js) for more.

If you would like to change the assets, please check the [Laravel Mix documentations](https://laravel-mix.com/docs/6.0/installation):

* [Prerequisite steps](https://laravel-mix.com/docs/6.0/workflow)
* [Build steps](https://laravel-mix.com/docs/6.0/cli)

### Commercial Mesh Plugins

Some Gentics Mesh plugins are not available for free, but we built some examples with these also (eg.: Ratings with the
Likes plugin). Please refer to these plugins at [Gentics Mesh documentations](https://getmesh.io/docs/plugins/#_commercial_plugins).
Not installing these plugins should not cause any problems, just the missing feature will not displayed.