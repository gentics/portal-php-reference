#!/bin/bash

##
## Initial setup of Mesh privileges on the Reference project
##
## TODO: Change this to mesh-cli if it supports websockets
##

set -o nounset
#set -o errexit

MESH_URL=""
MESH_APIKEY=""

REFERENCE_ROLE="reference_role"
REFERENCE_GROUP="reference_group"

function usage() {
	echo "Usage: $0 URL APIKEY"
	echo
	echo
	echo "Example:"
	echo "$0 http://localhost:8080 eyJ0..."

	exit 1
}

function meshGET() { 
	local url="$MESH_URL"
	local token="$MESH_APIKEY"
	local json=""
	local request=$1

	json=$(curl -s --fail -H "Authorization: Bearer $token" -X GET "${url}${request}")
	echo ${json}
}

function meshPOST() {
	local url="$MESH_URL"
	local token="$MESH_APIKEY"
	local json=""
	local request=$1
	local payload=$2

	json=$(curl -s --fail -H "Authorization: Bearer $token" -H "Content-Type: application/json" -X POST -d "$payload" "${url}${request}")
	echo ${json}
}

if [[ "$#" -lt 2 ]] ; then
  usage
fi

if [[ "$#" -eq 2 ]] ; then
  MESH_URL=$1
  MESH_APIKEY=$2

  HAS_USER_ROLE=$(meshGET /api/v1/roles | jq -r '.data[] | [(.uuid), .name] | @tsv' | grep "$REFERENCE_ROLE")
  HAS_USER_GROUP=$(meshGET /api/v1/groups | jq -r '.data[] | [(.uuid), .name] | @tsv' | grep "$REFERENCE_GROUP")

  ROLEUUID=""
  GROUPUUID=""

  if [ -z "$HAS_USER_ROLE" ]; then
    echo "MeshSetup: Add ${REFERENCE_ROLE} role"
    ROLEUUID=$(meshPOST /api/v1/roles "{\"name\":\"${REFERENCE_ROLE}\"}" | jq --raw-output .uuid)
  else
    ROLEUUID=$(echo $HAS_USER_ROLE | awk '{ print $1 }')
  fi

  if [ -z "$HAS_USER_GROUP" ]; then
    echo "MeshSetup: Add ${REFERENCE_GROUP} group"
    GROUPUUID=$(meshPOST /api/v1/groups "{\"name\":\"${REFERENCE_GROUP}\"}" | jq --raw-output .uuid)

    if [ ! -z "$ROLEUUID" ] && [ ! -z "$GROUPUUID" ]; then
       echo "MeshSetup: Assign ${REFERENCE_ROLE} to ${REFERENCE_GROUP}"
       GROUPROLE=$(meshPOST "/api/v1/groups/${GROUPUUID}/roles/${ROLEUUID}" "")
    fi
  fi
fi
