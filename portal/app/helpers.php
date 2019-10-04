<?php

use Gentics\PortalPhp\PortalPhp;
use Gentics\PortalPhp\RenderMode;
use Gentics\PortalPhp\Features\Helpers\Helper;

if (! function_exists('sortByNavSortOrder')) {
    /**
     * Sorts navigation by navsortorder field
     * @param array $elements Elements of rootNode children
     * @return mixed
     */
    function sortByNavSortOrder(array $elements)
    {
        return Helper::sortByNavSortOrder($elements);
    }
}

if (! function_exists('expandJsonTags')) {
    /**
     * Expands specific array keys with json_decode on specified array.
     *
     * @param array $array Input array to be json expanded
     * @param array $keys Specific keys to be json expanded
     */
    function expandJsonTags(array &$array, array $keys = [])
    {
        array_walk_recursive($array, function (&$item, $key) use ($keys) {
            if (in_array($key, $keys)) {
                $item = json_decode($item, true);

                // Replace tag values for CMS Preview mode
                if (isCmsPreview() && is_array($item)) {
                    $dotItem = array_dot($item);
                    foreach ($dotItem as $key => $value) {
                        array_set($item, $key, "<node {$key}>");
                    }
                }
            }
        });
    }
}

if (! function_exists('gisImage')) {
    /**
     * Generates GenticsImageStore URL
     *
     * @param string $width
     * @param string $height
     * @param string $mode
     * @param $path
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @return string
     */
    function gisImage(string $width, string $height, string $mode, $path = null)
    {
        if (isCmsPreview()) {
            return $path;
        }

        return url('/GenticsImageStore', ['width' => $width, 'height' => $height, 'mode' => $mode])
            . parse_url($path, PHP_URL_PATH);
    }
}

if (! function_exists('isCmsPreview')) {
    /**
     * Tells if the current state is CMS Preview or not by the actual controller name
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    function isCmsPreview()
    {
        $portalPhp = app()->make(PortalPhp::class);
        $renderMode = $portalPhp->renderMode();

        if ($renderMode === RenderMode::PREVIEW || $renderMode === RenderMode::EDIT) {
            return true;
        }

        return false;
    }
}

if (! function_exists('build_url')) {
    /**
     * @param array $parts
     * @return string
     */
    function build_url(array $parts)
    {
        $scheme   = isset($parts['scheme']) ? ($parts['scheme'] . '://') : '';

        $host     = ($parts['host'] ?? '');
        $port     = isset($parts['port']) ? (':' . $parts['port']) : '';

        $user     = ($parts['user'] ?? '');

        $pass     = isset($parts['pass']) ? (':' . $parts['pass'])  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';

        $path     = ($parts['path'] ?? '');
        $query    = isset($parts['query']) ? ('?' . $parts['query']) : '';
        $fragment = isset($parts['fragment']) ? ('#' . $parts['fragment']) : '';

        return implode('', [$scheme, $user, $pass, $host, $port, $path, $query, $fragment]);
    }
}

if (! function_exists('urlWithParams')) {
    /**
     * @param string $url
     * @param array $params
     * @return string
     */
    function urlWithParams(string $url, array $params = [])
    {
        $parsed = parse_url($url);
        $query = '';

        if (!empty($parsed['query'])) {
            $query = $parsed['query'] . '&';
        }

        $query .= http_build_query($params);
        $parsed['query'] = $query;

        return build_url($parsed);
    }
}
