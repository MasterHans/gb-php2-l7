<form action="<?php echo $actForm;  ?>" method="post">
    <label for="title">Заголовок Новости:</label>
    <br>
    <input type="text" id="title" name="title" value="<?php echo $title ?>">
    <br>
    <label for="text">Текст Новости:</label>
    <br>
    <textarea name="text" id="text" cols="30" rows="10"><?php echo $text ?></textarea>
    <br>
    <label for="n_date">Дата Новости:</label>
    <br>
    <input type="date" id="n_date" name="n_date" value="<?php echo $n_date ?>">
    <br>
    <input type="submit">
</form>
