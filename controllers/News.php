<?php

namespace Application\Controllers;

use Application\Models\News as NewsModel;

class News
{
    public function actionAll(){

        $article = NewsModel::findAll();

        if ( empty($article) ) {
            $e = new E404Exception('Нет новостей в БД!!!');
            throw $e;
        }

        $view = new \View(); // создали объект
        $view->items = $article;
        $view->display('news/all.php');

    }

    public function actionOne(){
        $pathParts = explode('/',parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
        $id = $pathParts[3];
        $item = NewsModel::findOneByPk($id);

        if ( empty($item) ) {
            $e = new E404Exception('Новость c article_id = ' . $id . ' не найдена в БД!!!');
            throw $e;
        }

        $view = new \View(); // создали объект
        $view->item = $item;
        $view->display('news/one.php'); // дали команду на показ шаблона с указанными ранее данными
    }


}