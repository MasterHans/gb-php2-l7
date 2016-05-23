<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
        <title><?php echo $item->title; ?></title>
</head>
<body>
    <a href="\">На главную</a>
        <div class="article">
            <h2><?php echo $item->title; ?></h2>
            <h5><?php echo $item->n_date; ?></h5>
            <p><?php echo $item->text; ?></p>
        </div>
</body>
</html>
