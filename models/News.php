<?php

/**
 * Class NewsModel
 * @property $article_id
 * @property $title
 * @property $text
 * @property $n_date
 */

namespace Application\Models;

class News
    extends \AbstractModel
{
    protected static $table='news';

}