#!/bin/bash

set -o errexit
set -o nounset

# Portal initializations tasks in background
portal-init.sh &

# Continue with entrypoint
docker-php-entrypoint $@
