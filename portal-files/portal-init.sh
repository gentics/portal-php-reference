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

if (( ${#MESH_APIKEY} < 32 )); then
        waitForMesh.sh $MESH_URL 300
        MESH_APIKEY=$(mesh-gen-token.sh $MESH_URL)
        echo "Generated new Mesh API token: $MESH_APIKEY"
        sed -i "s/MESH_APIKEY=.*/MESH_APIKEY=\"$MESH_APIKEY\"/g" $envFile
fi
