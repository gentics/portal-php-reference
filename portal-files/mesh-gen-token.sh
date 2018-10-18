#!/bin/bash

set -o nounset
set -o errexit

USER="admin"
PASSWORD="admin"

function usage() {
	echo "Usage: $0 URL [options]"
	echo
	echo "Options:"
	echo "  -f: Force the API key update in $LOCALCONF and override any existing key"
	echo
	echo "Example:"
	echo "$0 http://localhost:8080"

	exit 1
}

function generateKey() { 
	local url="$1"
	local json=""

	# Login to admin
	json=$(curl -s --fail -H "Content-Type: application/json" -X POST -d "{\"username\": \"$USER\", \"password\": \"$PASSWORD\"}" $url/api/v1/auth/login)
	local loginToken=$(echo $json | jq --raw-output .token)

	# Get uuid of admin user
	json=$(curl -s  --fail -H "Authorization:  Bearer $loginToken" $url/api/v1/auth/me)
	local uuid=$(echo $json | jq --raw-output .uuid)

	# Now generate API token
	json=$(curl -s --fail -H "Authorization:  Bearer $loginToken" -X POST $url/api/v1/users/$uuid/token)
	local apiKey=$(echo $json | jq --raw-output .token)

	echo ${apiKey}
}

if [[ "$#" -eq 0 ]] ; then
  usage
fi

if [[ "$#" -eq 1 ]] ; then
  generateKey $1
fi
