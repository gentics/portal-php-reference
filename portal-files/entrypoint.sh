#!/bin/bash

set -o errexit

# Portal initializations tasks in background
portal-init.sh &

# Continue with entrypoint
docker-php-entrypoint $@
