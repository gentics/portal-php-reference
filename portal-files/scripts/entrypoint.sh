#!/bin/bash

set -o errexit

if [[ $SKIP_ENTRYPOINT_CHMOD != "true" ]]; then

    # Make some directories writable for www-data
    if [ -d /portal/storage ]; then
    	chgrp -R www-data /portal/storage
    	chmod -R g+w /portal/storage
    fi
    
    if [ -d /portal/bootstrap/cache ]; then
    	chgrp -R www-data /portal/bootstrap/cache
    	chmod -R g+w /portal/bootstrap/cache
    fi

fi

# Source the .env file if it is mounted/exists
envFile="/portal/.env"
if [ -f "$envFile" ] && [ -f "${envFile}.example" ]; then
	. $envFile
fi 

# Generate app key if it doesn't exist, and if the env file exists
if [[ $AUTOGENERATE_APP_KEY != "false" && $APP_KEY == "" && -f "$envFile" ]]; then
	php artisan key:generate
fi

if [[ $XDEBUG_ENABLED == "true" ]]; then
	echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini
fi

docker-php-entrypoint $@