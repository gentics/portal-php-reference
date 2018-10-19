#!/bin/bash

set -o errexit

# Make some directories writable for www-data
if [ -d /portal/storage ]; then
	chgrp -R www-data /portal/storage
	chmod -R g+w /portal/storage
fi

if [ -d /portal/bootstrap/cache ]; then
	chgrp -R www-data /portal/bootstrap/cache
	chmod -R g+w /portal/bootstrap/cache
fi

# Generate API key for Mesh
envFile="/portal/.env"

if [ ! -f "$envFile" ] && [ -f "${envFile}.example" ]; then
	cp -a "${envFile}.example" "${envFile}"
fi 

. $envFile

if [ ${MESH_URL:+non-existing} ]; then
	MESH_URL="http://mesh:8080"
fi

if [[ ${MESH_APIKEY:+non-existing} || (( ${#MESH_APIKEY} < 32 )) ]]; then
	waitForMesh.sh $MESH_URL 300
	MESH_APIKEY=$(mesh-gen-token.sh $MESH_URL)
	echo "Generated new Mesh API token: $MESH_APIKEY"

	if grep -q "^MESH_APIKEY=.*" $envFile
	then
		sed -i "s/MESH_APIKEY=.*/MESH_APIKEY=\"$MESH_APIKEY\"/g" $envFile
	else
		echo "" >> $envFile
		echo "MESH_URL=\"$MESH_URL\"" >> $envFile
	    echo "MESH_APIKEY=\"$MESH_APIKEY\"" >> $envFile
	fi
	
fi

docker-php-entrypoint $@
