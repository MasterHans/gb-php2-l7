<?php

function __autoload($class){

    $classParts = explode('\\', $class);


    if (strpos($classParts[0], 'Mailer')>0) {
        $path = __DIR__ . '/vendor/phpmailer/phpmailer/' . 'class.' . $classParts[0] . '.php';
    } elseif (strpos($classParts[0], 'Timer')>0) {
        $path = __DIR__ . '/vendor/phpunit/php-timer/src/Timer.php';
    } else {
        $classParts[0] = __DIR__;
        $path = implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
    }

//    var_dump($path);

    if (file_exists($path)) {
        require $path;
    }

}