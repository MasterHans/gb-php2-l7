<?php

function ownAutoload($class){

    $classParts = explode('\\', $class);

        $classParts[0] = __DIR__;
        $path = implode(DIRECTORY_SEPARATOR, $classParts) . '.php';

        if (file_exists($path)) {
            require $path;
        }

}

spl_autoload_register('ownAutoload');
require __DIR__ . '/vendor/autoload.php';
