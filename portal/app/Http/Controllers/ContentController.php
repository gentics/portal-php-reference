<?php

namespace App\Http\Controllers;

class ContentController extends \Gentics\PortalPhp\Http\Controllers\ContentController
{
    /**
     * Action that loads the requested node from Mesh
     *
     * @param string $path
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\StreamedResponse|void
     * @throws \Throwable
     */
    public function index(string $pathPrefix = "0", ?string $path = null)
    {
        // handle no channel prefix in url
        if ($path === null) {
            $path = 'Home.html';
        }
        // map pathPrefix to branch.name
        switch($pathPrefix) {
            case '0':
            $branch = 'Portal_PHP_Reference';
            break;
            case '1':
            $branch = 'Portal_PHP_Reference_Channel';
            break;
            default:
            $branch = 'Portal_PHP_Reference';
        }
        $path = '/' . $pathPrefix . '/' . $path;
        // Workaround for bug where the startpage property of the root node folder in the CMS is not being published
        if ($path === '/') {
            return parent::index('/0/Home.html', $branch);
        }

        return parent::index($path, $branch);
    }
}
