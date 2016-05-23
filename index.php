<?php
require_once __DIR__ . '/autoload.php';

$ctrl = isset($_GET['ctrl']) ? $_GET['ctrl'] : 'News';
$act = isset($_GET['act']) ? $_GET['act'] : 'All';

$controllerClassName = $ctrl . 'Controller';

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

