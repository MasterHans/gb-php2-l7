<?php
function __autoload($class){

    $classParts = explode('\\', $class);

    $classParts[0] = __DIR__;
    $path =  implode(DIRECTORY_SEPARATOR, $classParts) . '.php';

    if (file_exists($path)) {
        require $path;
    }

}