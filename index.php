<?php
require_once __DIR__ . '/autoload.php';

$path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$pathParts = explode('/',$path);

$ctrl = !empty($pathParts[1]) ? ucfirst($pathParts[1]) : 'News';
$act = !empty($pathParts[2]) ? ucfirst($pathParts[2]) : 'All';

$controllerClassName = 'Application\\Controllers\\' . $ctrl;

try {

        $controller = new $controllerClassName;
        $method = 'action' . $act;
        $controller->$method();

} catch (PDOException $e) {
    $error = new View();
    $error->error = $e->getMessage();
    $error->display('403.php');

    $log = new EventLog();
    $log->time = 'Время события: ' . date('H:i') . "\n";
    $log->place = 'Место возникновения : ' . $e->getFile() . "\n";
    $log->message = 'Текст сообщения : ' . $e->getMessage() . "\n";
    $log->writeToLog();
    die;
} catch (E404Exception $e) {
    $error = new View();
    $error->error = $e->getMessage();
    $error->display('404.php');

    $log = new EventLog();
    $log->time = 'Время события: ' . date('H:i') . "\n";
    $log->place = 'Место возникновения : ' . $e->getFile() . "\n";
    $log->message = 'Текст сообщения : ' . $e->getMessage() . "\n";
    $log->writeToLog();
    die;
}

