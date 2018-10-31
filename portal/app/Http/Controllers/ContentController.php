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
    public function index(string $path = '/', ?string $branch = null)
    {
        // Workaround for bug where the startpage property of the root node folder in the CMS is not being published
        if ($path === '/') {
            return parent::index('/Home.html', $branch);
        }

        return parent::index($path, $branch);
    }
}
