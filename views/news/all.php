<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новостная лента</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<header>
    <h1>Новостная лента:<?php echo date('d.m.Y');?></h1>
</header>
<div class="content">
    <a href="/admin/viewlog/">Просмотр Лога</a>
    <?php foreach ($items as $item): ?>
        <div class="article">
            <h2><?php echo $item->title; ?></h2>
            <h5><?php echo $item->n_date; ?></h5>
            <p><?php echo $item->text; ?></p>
        </div>
        <div class="panel">
            <ul>
                <li><a href="/news/one/<?php echo $item->article_id; ?>">Читать</a></li>
                <li><a href="/admin/edit/<?php echo $item->article_id; ?>">Редактировать</a></li>
                <li><a href="/admin/delete/<?php echo $item->article_id; ?>">Удалить</a></li>
            </ul>
        </div>
    <?php endforeach; ?>

    <div class="add-form">
        <?php
            $actForm = '/index.php?ctrl=Admin&act=Insert';
            require_once __DIR__ . '/../../views/news/form.php'
        ?>
    </div>
</div>


</body>
</html>


