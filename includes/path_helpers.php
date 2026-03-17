<?php

if (!function_exists('osf_resolve_image_path')) {
    function osf_resolve_image_path($path)
    {
        $path = trim((string)$path);
        if ($path === '') {
            return '';
        }

        if (preg_match('~^(?:data:|https?://|//)~i', $path)) {
            return $path;
        }

        $path = str_replace('\\', '/', $path);
        if (strpos($path, '../') === 0) {
            return $path;
        }

        if (strpos($path, 'images/') === 0) {
            return '../' . $path;
        }

        return '../images/' . ltrim($path, '/');
    }
}
?>
