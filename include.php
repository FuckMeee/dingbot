<?php

spl_autoload_register(function ($classname) {
    echo $classname . "\n";
    $pathname = __DIR__ . '\src' . DIRECTORY_SEPARATOR;
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    echo $filename . "\n";
    echo $pathname . $filename . "\n";
    if (file_exists($pathname . $filename)) {
        echo 111111111111111111111111111111111111111111111 . "\n";

        foreach (['Message', 'Support'] as $prefix) {
            if (stripos($classname, $prefix) === 0) {
                include $pathname . $filename;
                return true;
            }
        }
    }
    return false;
});