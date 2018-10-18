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
    | Target Mesh project for queries
    |--------------------------------------------------------------------------
    |
    | This is the default project and can be overridden in your Controller
    |
    */
    'projectName' => 'Portal_PHP_Reference',

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
        'default' => 'errors/',
    ],

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
    | HTTP headers listed here will be passed through to the client
    |
    */
    'webrootHttpHeaderWhiteList' => [
        'ETag',
        'Content-Type',
        'Content-Length',
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
    | Data Provider
    |--------------------------------------------------------------------------
    |
    | Data Provider fetches and caches global settings of the portal from Mesh.
    |
    | cacheTime: Specifies the time in minutes until the last fetched values
    | should be used without updating.
    | meshData: An associative array, which tells the source of the Data Provider
    | values assigned to keys. Example: 'config' => 'settings/Config.html'
    | expandJsonKeys: Allows JSON values on specified from the response keys to
    | be expanded as arrays automatically.
    |
    */

    'dataProvider' => [
        // Fetched data to be cached in minutes
        'cacheTime' => 1,

        // DataProvider Mesh paths
        'meshData' => [
            'config' => 'settings/Configuration.html',
        ],

        // JSON containing keys, which should be decoded
        'expandJsonKeys' => [
            'tagsData'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Elastic Search
    |--------------------------------------------------------------------------
    |
    | The perPage option specifies the search results page length, and after
    | that limit, pagination will applied.
    |
    | The filterKeys provides a way to define queryParams to be assigned with
    | different Elastic Search queries. The {searchQuery} placeholder will be
    | replaced with the according query parameter's value.
    |
    */
    'elasticSearch' => [
        // Results per page
        'perPage' => 25,

        // Filter keys are used as search filter variables
        'filterKeys' => [
            // Default filter key
            'q' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'multi_match' => [
                                    'query' => '{searchQuery}',
                                    'type' => 'phrase',
                                    'fields' => [
                                        'fields.name',
                                        'fields.vehicle_description',
                                    ],
                                ],
                            ],
                            [
                                'term' => [
                                    'fields.templateName.raw' => 'vehicle',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'category' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'term' => [
                                    'parent.displayName.raw' => '{searchQuery}',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
