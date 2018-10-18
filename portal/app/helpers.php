<?php

if (! function_exists('sortByNavSortOrder')) {
    /**
     * Sorts navigation by navsortorder field
     * @param $elements
     * @return mixed
     */
    function sortByNavSortOrder($elements)
    {
        usort($elements, function ($a, $b) {
            return (intval($a['fields']['navsortorder'] ?? 0)) <=> (intval($b['fields']['navsortorder'] ?? 0));
        });

        return $elements;
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
     * @return string
     */
    function gisImage(string $width, string $height, string $mode, $path = null)
    {
        if (isCmsPreview()) {
            return $path;
        }

        return url('/GenticsImageStore', ['width' => $width, 'height' => $height, 'mode' => $mode]) . parse_url($path, PHP_URL_PATH);
    }
}

if (! function_exists('isCmsPreview')) {
    /**
     * Tells if the current state is CMS Preview or not by the actual controller name
     * @return bool
     */
    function isCmsPreview()
    {
        $action = app('request')->route()->getAction();
        $controller = class_basename($action['controller']);

        list($controller, $action) = explode('@', $controller);

        if ($controller == 'CmsController') {
            return true;
        }

        return false;
    }
}
