<?php

if (! function_exists('public_storage_url')) {
    /**
     * URL for files stored on the public disk.
     * Uses /media/... so shared hosting works without a working storage symlink.
     */
    function public_storage_url(?string $path): string
    {
        if ($path === null || $path === '') {
            return '';
        }

        $path = str_replace('\\', '/', $path);
        $path = ltrim($path, '/');

        foreach (['storage/app/public/', 'app/public/', 'public/', 'storage/'] as $prefix) {
            if (str_starts_with($path, $prefix)) {
                $path = substr($path, strlen($prefix));
            }
        }

        return url('media/'.$path);
    }
}
