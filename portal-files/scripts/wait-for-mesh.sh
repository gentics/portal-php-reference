#!/bin/bash

# Poll the mesh status until a specified
# timeout is reached or the server becomes ready

set -o errexit

function usage() {
  echo "Usage: $0 MESH_URL TIMEOUT_IN_SEC"
  echo ""
  echo "$0 http://localhost:8080 120"
  exit 1
}

function wait() {
  local url=$1
  local timeout=$2
  for i in $(seq 1 $timeout) ; do
    sleep 1
    local status=$(curl -s -b $cookieFile -X GET $url/api/v1/admin/status  | jq --raw-output '.status')
    if [ "$status" == "READY" ] ; then
      echo -e "\e[32mGot ready status. Stoping wait.\e[0m"
      exit 0
    else
      echo "Waiting: $i of $timeout - Current status: $status"
    fi
  done
  echo -e "\e[31mTimeout of $timeout seconds reached.\e[0m"
}

if [ $# -eq 0 ]; then
  usage
fi

if [ $# -eq 2 ] ; then
  wait $1 $2
  exit 0
fi

usage
