<?php
function __autoload($class){

//    if (file_exists(__DIR__ . '/classes/' . $class . '.php')) {
//        require __DIR__ . '/classes/' . $class . '.php';
//    } elseif (file_exists(__DIR__ . '/models/' . $class . '.php')) {
//        require __DIR__ . '/models/' . $class . '.php';
//    } elseif (file_exists(__DIR__ . '/controllers/' . $class . '.php')) {
//        require __DIR__ . '/controllers/' . $class . '.php';
//    } elseif (file_exists(__DIR__ . '/views/' . $class . '.php')) {
//        require __DIR__ . '/views/' . $class . '.php';
//        var_dump($class);
//    } else {
        $classParts = explode('\\', $class);

        if (count($classParts) >1 ) {
            $classParts[0] = __DIR__;
            $path = implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
        }  else {
            $path = __DIR__ . '/classes/' . $classParts[0] . '.php';
        }

        if (file_exists($path)) {
            require $path;
        }
//    }
}