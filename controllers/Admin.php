<?php

namespace Application\Controllers;

use Application\Models\News as NewsModel;
use Application\lib_classes\EventLog;
use Application\lib_classes\View;

class Admin
{
    public function actionInsert(){
        if (!empty($_POST)){
            $data = [];
            if (!empty($_POST['title'])){
                $data['title'] = $_POST['title'];
            }

            if (!empty($_POST['text'])){
                $data['text'] = $_POST['text'];
            }

            if (!empty($_POST['n_date'])){
                $data['n_date'] = $_POST['n_date'];
            }

            if (isset($data['title']) && isset($data['text']) && isset($data['n_date'])) {
                $article = new NewsModel();
                $article->fillData($data);
                $article->save();
                header('Location: /');
                die;
            }
        }

    }
    public function actionEdit(){
        $pathParts = explode('/',parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
        $id = $pathParts[3];
        $Item = NewsModel::findOneByPk($id);


        $title = $Item->title;
        $text = $Item->text;
        $n_date = $Item->n_date;
        $article_id = $Item->article_id;

        $actForm = '/admin/update/' . $article_id;
        require_once __DIR__ . '/../views/news/form.php';
    }
    public function actionUpdate(){
        if (!empty($_POST)){
            $data = [];
            if (!empty($_POST['title'])){
                $data['title'] = $_POST['title'];
            }

            if (!empty($_POST['text'])){
                $data['text'] = $_POST['text'];
            }

            if (!empty($_POST['n_date'])){
                $data['n_date'] = $_POST['n_date'];
            }

            $pathParts = explode('/',parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
            $data['article_id'] = $pathParts[3];

            if (isset($data['title']) && isset($data['text']) && isset($data['n_date'])) {
                $article = new NewsModel();
                $article->fillData($data);

                $article->save();
                header('Location: /');
                die;
            }
        }
    }
    public function actionDelete()
    {
        $pathParts = explode('/',parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));

        $article = new NewsModel();
        $article->article_id = $pathParts[3];
        $article->delete();

        header('Location: /');
        die;
    }
    public function actionViewLog()
    {
        $log = new EventLog();
        $LogItems = $log->getLog();

        $view = new View(); // создали объект
        $view->items = $LogItems;
        $view->display('log.php');
    }
}