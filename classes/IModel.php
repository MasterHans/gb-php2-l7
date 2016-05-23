<?php

interface IModel
{
    /*Никогда не пишем реализацию. Здесь только публичные методы*/
    public static function getAll();
    public static function getOne($id);

}