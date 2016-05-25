<?php
$content = file_get_contents(__DIR__ . '/text.json');
$obj = json_decode($content);
var_dump($obj);
echo $obj[1]->obd;
echo '<br>';

$obj = new stdClass();
$obj->title = 'Ночной дозор';
$obj->text = 'Текст дозора';

echo json_encode($obj);