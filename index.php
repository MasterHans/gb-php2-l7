<?php

use Application\lib_classes\EventLog;
use Application\lib_classes\View;
use Application\lib_classes\E404Exception;

$path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$pathParts = explode('/',$path);

$ctrl = !empty($pathParts[1]) ? ucfirst($pathParts[1]) : 'News';
$act = !empty($pathParts[2]) ? ucfirst($pathParts[2]) : 'All';

$controllerClassName = 'Application\\Controllers\\' . $ctrl;



/*Подсчёт времени*/
PHP_Timer::start();


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

    $mail = new PHPMailer;
//Set who the message is to be sent from
    $mail->setFrom('ganzopa@mail.ru', 'First Last');
//Set an alternative reply-to address
    $mail->addReplyTo('l_mk@bk.ru', 'First Last');
//Set who the message is to be sent to
    $mail->addAddress('suvorov.ag.75@gmail.com', 'John Doe');
//Set the subject line
    $mail->Subject = 'PHPMailer mail() test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
    $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';
//Attach an image file
    $mail->addAttachment(__DIR__ . 'vendor/phpmailer/phpmailer/images/phpmailer_mini.png');

//send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }

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

$time = PHP_Timer::stop();

print PHP_Timer::secondsToTimeString($time);