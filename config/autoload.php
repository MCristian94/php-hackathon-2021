<?php

function autoload($filename)
{
    $filename = explode('\\', $filename);
    $path = __DIR__ . "/..";
    foreach ($filename as $Name) {
        $path = $path . DIRECTORY_SEPARATOR . $Name;
    }
    $fileToInclude = $path . ".php";
    if (file_exists($fileToInclude)) {
        require_once $fileToInclude;
    }
    $fileToInclude = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . $filename[1] . ".php";
    if (file_exists($fileToInclude)) {
        require_once $fileToInclude;
    }
}

spl_autoload_register('autoload');
