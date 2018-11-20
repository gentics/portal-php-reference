#!/bin/bash

set -o errexit
set -o nounset

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
		# When the .env file is a mount, --in-place of sed doesn't work, because
		# it creates a temporary file and trys to rename it. So we use a temp file instead.
		sed_temp_file=$(mktemp /tmp/sed_temp_file.XXXXXX)
		sed "s/MESH_APIKEY=.*/MESH_APIKEY=\"$MESH_APIKEY\"/g" $envFile > $sed_temp_file
		cp $sed_temp_file $envFile
	else
		echo "" >> $envFile
		echo "MESH_URL=\"$MESH_URL\"" >> $envFile
	    echo "MESH_APIKEY=\"$MESH_APIKEY\"" >> $envFile
	fi
  
  echo "Setup Portal defaults..."
	meshSetup.sh $MESH_URL "$MESH_APIKEY"
fi

docker-php-entrypoint $@
