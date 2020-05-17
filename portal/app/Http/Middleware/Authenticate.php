<?php

namespace App\Http\Middleware;

use Gentics\PortalPhp\Features\Keycloak\Http\Middleware\Authenticate as Middleware;

if (app()->bound()) {
    class Authenticate extends Middleware
    {
    }
}
