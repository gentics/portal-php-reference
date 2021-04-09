<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Url to Mesh - e.g. http://localhost:80
    |--------------------------------------------------------------------------
    */
    'url' => env('MESH_URL', 'http://mesh:8080'),

    /*
    |--------------------------------------------------------------------------
    | API Token to access Mesh
    |--------------------------------------------------------------------------
    */
    'apiKey' => env('MESH_APIKEY'),

    /*
    |--------------------------------------------------------------------------
    | Start Page used by Portal to redirect or link to home.
    |--------------------------------------------------------------------------
    */
    'startPage' => '/Home.html',

    /*
    |--------------------------------------------------------------------------
    | Target Mesh project for queries
    |--------------------------------------------------------------------------
    |
    | This is the default project and can be overridden in your Controller
    |
    */
    'projectName' => 'Portal_PHP_Reference',

    /*
    |--------------------------------------------------------------------------
    | Global Router prefix
    |--------------------------------------------------------------------------
    |
    | It is possible to specify a Global Router prefix which prepends all
    | portal routes with this string.
    |
    */
    //'routerPrefix' => '',

    /*
    |--------------------------------------------------------------------------
    | Use Mesh Content branches
    |--------------------------------------------------------------------------
    |
    | Set enabled to true, to use Mesh branches (Gentics CMS Multichannelling).
    | When this is enabled, the hostname and the path prefix of the incoming
    | client request is matched to the branch list of the Mesh project and
    | the correct branch to use for API requests will be chosen automatically.
    | See:
    | * https://getmesh.io/docs/features/#_content_branches
    | * https://www.gentics.com/Content.Node/guides/mesh_cr_implementation_branches.html
    |
    | matchHttpHost:         Whether to match the hostname of the incoming
    |                        request with the branch host
    | matchPageDirectory:    Whether to match the request path with the
    |                        page directory prefixes of the Mesh branches
    | implementationVersion: The implementation version to use, set null to
    |                        not use. This allows you to seamlessly migrate
    |                        your project to a newer version without downtime
    |                        by increasing the field in the CR Administration
    |                        of your CMS.
    */
    'branches' => [
        'enabled'               => true,
        'matchHttpHost'         => true,
        'matchPageDirectory'    => true,
        'implementationVersion' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache options
    |--------------------------------------------------------------------------
    |
    | Feature specific cache options (see option descriptions).
    |
    | etag:
    |   cacheTime:          Etag Response headers cache time in seconds
    |
    | binary:
    |   cacheControl:
    |       maxAge:         Forced max-age header for binaries
    |
    | errorPage:
    |   cacheTime:          Error Pages cache time in seconds
    |
    | navigation:
    |   cacheTime:          Navigation cache time in seconds
    |
    | user:
    |   cacheTime:          User data cache time in seconds
    |
    | http:
    |   enabled:            Enable HTTP Full Reponse Cache
    |   cacheTime:          Default response cache time
    |   options:            Configure Symfony HttpCache options, see:
    |                       * https://symfony.com/doc/current/book/http_cache.html#symfony2-reverse-proxy
    |   context:            User context to match the cached content, if not set or empty, defaults will be used:
    |                           * roleshash (default) - Role hash
    |                           * language (default) - User language
    |                           * branch (default) - Branch
    |                           * claim_* - Any claim from the JWT token
    |                           * cookie_* - Any cookie
    |   mimeTypes:          Allowed MIME-types for full response cache
    |                       (compares against the beginning of the MIME-type)
    |
    */
    'cache' => [
        'etag'  => [
            'cacheTime' => 300
        ],
        'binary' => [
            'cacheControl' => [
                'maxAge' => 3600
            ],
        ],
        'errorPage' => [
            'cacheTime' => 300
        ],
        'navigation' => [
            'cacheTime' => 15
        ],
        'user' => [
            'cacheTime' => 15
        ],
        'http' => [
            'enabled'   => false,
            'cacheTime' => 60,
            'options'   => [],
            'context'   => [],
            'mimeTypes' => [
                'text/',
            ],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Default schema names used for fetching objects from the Mesh API
    |--------------------------------------------------------------------------
    */
    'schemas' => [
        'content'       => 'portalphp_content',
        'folder'        => 'portalphp_folder',
        'binarycontent' => 'portalphp_binary_content',
    ],

    /*
    |--------------------------------------------------------------------------
    | Path to "templateName" in GraphQL Response.
    |--------------------------------------------------------------------------
    |
    | The default string that will be used as blade template name.
    | If your GraphQL statement is nested, seperate the path by "."
    | e.g. "data.node.fields.templateName"
    |
    */
    'templateNamePath' => 'node.fields.templateName',

    /*
    |--------------------------------------------------------------------------
    | Exception handler
    |--------------------------------------------------------------------------
    |
    | For all exceptions, a custom error page can be defined. Each value must
    | be a string, defining a webroot path to the error page.
    | If none of the codes and exceptions matches, the 'default' is used.
    | 'default' can either be a webroot path or a folder. If a folder is
    | specified (must have a trailing slash), the path to the error page will
    | be constructed automatically. Example: errors/404.html
    | If no specific page is found in the folder, it will try to load
    | 'default.html' in that folder.
    | If none of the configured error pages can be found, the exception is not
    | handled by the PortalPhp exception handler and the app/Laravel
    | error handler comes into play.
    | Exceptions that are not HttpException are treated as HTTP code 500.
    | When app.debug is enabled and the exception is not an instance of
    | Symfony\Component\HttpKernel\Exception\HttpException, the exception will
    | be handled by Laravel (a pretty stacktrace is shown for debugging).
    | When an exception occurs during loading the custom error page, that new
    | exception will bubble up to the Laravel exception handler also.
    |
    */
    'exceptionHandler' => [
        'httpCodes' => [
            // 404 => 'errors/404.html',
            // 403 => 'errors/403.html',
        ],
        'default' => 'errors/',
    ],

    /*
    |--------------------------------------------------------------------------
    | Development Logging Channel
    |--------------------------------------------------------------------------
    |
    | This option is used by the PortalPhp::devLog() method, to determinate
    | the correct log channel to use. devLog() is used in various internal,
    | but important debugging paths.
    |
    | The following values are accepted:
    | debug, info, notice, warning, error, critical, alert, emergency
    |
    | Invalid values are falls back to debug.
    |
    */
    'devLogChannel' => 'debug',

    /*
    |--------------------------------------------------------------------------
    | Mesh Client Timeout
    |--------------------------------------------------------------------------
    |
    | After the specified time interval in seconds (float), when Mesh does not
    | respond, an exception will be raised.
    |
    | The default value is 0 (unlimited).
    |
    */
    'meshClientTimeout' => 0,

    /*
    |--------------------------------------------------------------------------
    | Mesh Client Health Check Timeout
    |--------------------------------------------------------------------------
    |
    | After the specified time interval in seconds (float), when Mesh does not
    | respond to the readiness check, the Portal will be in an unready state.
    |
    | The default value is 2.5 seconds.
    |
    */
    'meshClientHealthCheckTimeout' => 2.5,

    /*
    |--------------------------------------------------------------------------
    | Debugger
    |--------------------------------------------------------------------------
    |
    | A specialized key to enable the debug-view (Whoops handler).
    | The key has to be provided as a query-parameter in a request.
    | It's a per-request "APP_DEBUG" alternative, to enable debugging on a
    | system where debugging is generally turned off (ie. Production Systems).
    | If no key is provided (type is not string or the string is empty),
    | then the entire functionality is being ignored.
    | It is adviced to use a seperate key for each stage, which is at least 16
    | chars long (treat it as another password basically).
    |
    | This key also let the debugger to clear caches.
    |
    */
    'debuggerKey' => env('DEBUGGER_KEY', null),

    /*
    |--------------------------------------------------------------------------
    | Binary files extensions
    |--------------------------------------------------------------------------
    |
    | The mimeTypes list is used as an optimization to skip requesting the
    | JSON response for certain file types and directly deliver the
    | binary content from the webroot call. However if the webroot request
    | fails, the GraphQL API will still be queried afterwards.
    |
    */
    'binaryFilesGuesser' => [
        'mimeTypes' => [
            'application/octet-stream',
            'audio/',
            'image/',
            'video/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | HTTP headers white list for binary webroot requests
    |--------------------------------------------------------------------------
    |
    | HTTP headers listed here will be passed through to the client or the server
    | Supports wildcards * and ?. The matching is not case sensitive.
    |
    */
    'webrootHttpHeaderWhiteList' => [
        'request' => [
            'Cache-Control',
            'If-*',
            'Range',
        ],
        'response' => [
            'Accept-Ranges',
            'Cache-Control',
            'Content-Length',
            'Content-Range',
            'Content-Type',
            'ETag',
            'Expires',
            'Last-Modified',
            'Transfer-Encoding',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Default language
    |--------------------------------------------------------------------------
    |
    | This will be used when a page needs to be rendered, but the language
    | can't be read from the user session. This happens when the user never
    | has visited a page before.
    |
    */
    'defaultLanguage' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    |
    | Authentication provides currently Keycloak based OpenID Connect login and
    | registration. The settings can be downloaded from the Keycloak server and
    | copy to the proper fields. The redirect option is the callback url after
    | the authentication process from Keycloak.
    |
    | For settings, in Keycloak go to your Realm > Clients > Installation and
    | select Keycloak OIDC JSON then copy the following JSON details to this
    | configuration by the JSON name -> Config name order
    |
    | auth-server-url → authUrl
    | realm → realm
    | resource → client_id
    | credentials.secret → client_secret
    |
    | The loginEndpoint, logoutEndpoint and registerEndpoint can be used for
    | links in pages to specify urls for login/logout/register actions.
    |
    | ** You can disable the authentication completely by commenting out the
    | ** authentication section of the configuration.
    |
    | In this case, the general API key will be used for all Mesh request.
    |
    | By default, if the original Authenticate middleware not loaded, Portal | php
    | tries to load its own Middleware. If you do not want this behavior, please
    | disable it by setting disableMiddlewareAutoload to true.
    |
    */
    /*'authentication' => [
        'keycloak' => [
            'authUrl' => 'http://localhost:8083/auth',
            'realm' => 'reference',
            'client_id' => 'reference',
            'client_secret' => 'genticsp-orta-lphp-auth-referencexxx',
            'redirect' => 'http://localhost:8080/auth/callback',
            'logoutEndpoint' => '/auth/logout',
            'loginEndpoint' => '/auth/redirect',
            'registerEndpoint' => '/auth/register',
            'disableMiddlewareAutoload' => false,
        ],
    ],*/

    /*
    |--------------------------------------------------------------------------
    | Data Provider
    |--------------------------------------------------------------------------
    |
    | Data Provider fetches and caches global settings of the portal from Mesh.
    |
    | cacheTime: Specifies the time in seconds until the last fetched values
    | should be used without updating.
    | meshData: An associative array, which tells the source of the Data Provider
    | values assigned to keys. Example: 'config' => 'settings/Config.html'
    | expandJsonKeys: Allows JSON values on specified from the response keys to
    | be expanded as arrays automatically.
    |
    */
    'dataProvider' => [
        // Fetched data to be cached in seconds
        'cacheTime' => 60,

        // DataProvider Mesh paths
        'meshData' => [
            'config' => 'settings/Configuration.html',
            'redirects' => 'settings/Redirects.html',
        ],

        // JSON containing keys, which should be decoded
        'expandJsonKeys' => [
            'tagsData'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Redirects
    |--------------------------------------------------------------------------
    |
    | This is an opt-in feature, which can be enabled with the 'enabled' flag.
    |
    | The Redirects feature tries to redirect the visitor to a predefined page
    | from an old page if a 404 error occurs.
    |
    | The redirect map can be fetched from either a DataProvider or a CMS page.
    | For pages, the source can be reloaded on every request or can be cached
    | for a specified amount of seconds. The DataProvider source takes care of
    | this with its own cache rules. To use a DataProvider you need to prefix
    | the name of the DataProvider with 'dataProvider:' and the name of the
    | DataProvider. For CMS Pages you have to use the path to that page.
    | The format of the DataProvider or CMS page depends on the helperClass to
    | be used.
    |
    | It is possible to configure the global value for the redirect statuses to
    | either Permanent or Temporary.
    |
    | The redirect maps have to be parsed by a RedirectHelper class, if no class
    | is provided, then a built in class will be used. A helperClass can receive
    | settings as an array. The custom helper class must implement the
    | RedirectHelper interface.
    */
    'redirects' => [
        // To enable redirects this should be true
        'enabled' => true,

        // Load Once cache time in seconds
        'loadOnceCacheTime' => 300,

        // Global setting for Permanent 301 or Temporary 303 code redirects
        'permanentRedirects' => false,

        // Redirects source CMS Page with path or DataProvider with dataProvider:<name>
        'source' => 'dataProvider:redirects',

        // Load once or load every time (if non-DataProvider source used)
        'reload' => false,

        // Helper class to process the custom redirects map
        'helperClass' => \Gentics\PortalPhp\Features\Redirect\BasicRedirectHelper::class,

        // Helper settings to pass
        'helperConfig' => [
            'fieldName' => 'addredirecttag',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    |
    | Generic configuration for the Mesh Search Handler
    |
    | useAdminToken:    Uses the admin token instead of a user token or null
    |
    */
    'search' => [
        'useAdminToken' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Compatibility
    |--------------------------------------------------------------------------
    |
    | Compatibility options
    |
    | mapNodeResponse:    Whether the NodeResponse to GraphQL response mapper
    |                     should be applied for previews.
    |
    | useWebrootField:    WebrootField API Endpoint is available since
    |                     Gentics Mesh 1.6.9 and enabled by default. This option
    |                     is for backwards compatibility as a fallback.
    |
    */
    'compatibility' => [
        'mapNodeResponse' => true,
        'useWebrootField' => true,
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Sitemap
    |--------------------------------------------------------------------------
    |
    | Generic configuration for the Sitemap Handler
    |
    | disable:    Disables the sitemap feature and its routes
    |
    */
    'sitemap' => [
        'disable' => false,
    ],

];
