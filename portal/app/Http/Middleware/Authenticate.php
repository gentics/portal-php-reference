<?php

namespace App\Http\Middleware;

use Gentics\PortalPhp\Features\Keycloak\Http\Middleware\Authenticate as Middleware;
use Gentics\PortalPhp\Features\Keycloak\Contract\Authenticator;

if (app()->bound(Authenticator::class)) {
    class Authenticate extends Middleware
    {
    }
}
