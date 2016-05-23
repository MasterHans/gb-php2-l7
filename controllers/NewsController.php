<?php

class NewsController
{
    public function actionAll(){

//        $article = NewsModel::findByOneColumn('title','Новость №1');
//        var_dump($article);
        $article = NewsModel::findAll();

        if ( empty($article) ) {
            $e = new E404Exception('Нет новостей в БД!!!');
            throw $e;
        }

        $view = new View(); // создали объект
        $view->items = $article;
        $view->display('news/all.php');

    }

    public function actionOne(){
        $id = $_GET['article_id'];
        $item = NewsModel::findOneByPk($id);

        if ( empty($item) ) {
            $e = new E404Exception('Новость c article_id = ' . $id . ' не найдена в БД!!!');
            throw $e;
        }

        $view = new View(); // создали объект
        $view->item = $item;
        $view->display('news/one.php'); // дали команду на показ шаблона с указанными ранее данными
    }


}