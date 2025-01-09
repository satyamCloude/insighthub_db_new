<?php

if (!function_exists('getDirectorySize')) {
    /**
     * Calculate the total size of a directory in bytes.
     *
     * @param string $dir
     * @return int
     */
    function getDirectorySize($dir)
    {
        $size = 0;

        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file) {
            if ($file->isFile()) {
                $size += $file->getSize();
            }
        }

        return $size;
    }
}
