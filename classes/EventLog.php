<?php

class EventLog
{
    protected $logFile;
    public $dataLog = [];

//    public function __construct ()
//    {
//            $this->logFile = file_put_contents(__DIR__ . '/../Logs/log.txt',$this->dataLog, FILE_APPEND | LOCK_EX);
//    }

    public function __set ($k,$v)
    {
        $this->dataLog[$k] = $v;
    }

    public function __get ($k)
    {
        return $this->dataLog[$k];
    }

    public function writeToLog()
    {
//        iconv('UTF8','Windows-1251',$this->dataLog[0]);
        $this->logFile = file_put_contents(__DIR__ . '/../Logs/log.txt',$this->dataLog, FILE_APPEND | LOCK_EX);
    }

    public function getLog ()
    {
        if (file_exists(__DIR__ . '/../Logs/log.txt')) {
            return file(__DIR__ . '/../Logs/log.txt');
        } else {
            $e = new E404Exception('Файл лога отсутствует!');
            throw $e;
        }

    }
}