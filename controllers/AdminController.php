<?php

class AdminController
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
//                die;
//                foreach ($data as $key => $prop) {
//                    $article->$key = $prop;
//                }

                $article->save();
                header('Location: /');
                die;
            }
        }

    }
    public function actionEdit(){
        $id = $_GET['article_id'];
        $Item = NewsModel::findOneByPk($id);


        $title = $Item->title;
        $text = $Item->text;
        $n_date = $Item->n_date;
        $article_id = $Item->article_id;

        $actForm = '/index.php?ctrl=Admin&act=Update&article_id=' . $article_id;
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

            $data['article_id'] = $_GET['article_id'];

            if (isset($data['title']) && isset($data['text']) && isset($data['n_date'])) {
                $article = new NewsModel();
                $article->fillData($data);
//                die;
//                foreach ($data as $key => $prop) {
//                    $article->$key = $prop;
//                }
                $article->save();
                header('Location: /');
                die;
            }
        }
    }
    public function actionDelete()
    {
        $article = new NewsModel();
        $article->article_id = $_GET['article_id'];
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