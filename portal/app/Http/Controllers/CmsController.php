<?php

namespace App\Http\Controllers;

class CmsController extends \Gentics\PortalPhp\Http\Controllers\CmsController
{
    /**
     * Action that loads the requested node from Mesh
     *
     * @param string $path
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\StreamedResponse|void
     * @throws \Throwable
     */
    public function index(string $folderPath = "/", ?string $branch = null)
    {
        // TODO split folderPath into prefix and path
        $pathPrefix = "";
        $path = "";

        // TODO abort if path is null
        // TODO handle http://localhost:8081/api/preview/0/ or http://localhost:8081/api/preview/0

        // handle no channel prefix in url
        if ($path === null) {
            $path = '/';
        }
        dd($path);
        // map pathPrefix to branch.name
        switch($pathPrefix) {
            // master branch name
            case '0':
                $branch = 'Portal_PHP_Reference';
                break;
            case '1':
            // channel branch name
                $branch = 'Portal_PHP_Reference_Channel';
                break;
            default:
                $branch = 'Portal_PHP_Reference';
        }
        $path = '/' . $pathPrefix . '/' . $path;
        // Workaround for bug where the startpage property of the root node folder in the CMS is not being published
        if ($path === '/') {
            return parent::index('/0', $branch);
        }

        return parent::index($path, $branch);
    }
}
