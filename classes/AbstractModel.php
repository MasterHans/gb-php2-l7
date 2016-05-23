<?php


class AbstractModel
{
    protected static $table;
    protected $data = [];


    public function __set ($k, $v)
    {
        $this->data[$k] = $v;
    }

    public function __get ($k)
    {
        return $this->data[$k];
    }

    public function __isset ($k)
    {
        return isset($this->data[$k]);
    }

    public static function findAll()
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM ' . static::$table;

        $db = new DB();
        $db->setClassName($class);
        return $db->query($sql);
    }

    public static function findOneByPk($id)
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE article_id=:id';

        $db = new DB();
        $db->setClassName($class);
        return $db->query($sql,[':id' => $id])[0];
    }

    public static function findByOneColumn($column, $value)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $column . '=:value';

        $db = new DB();
        $db->setClassName(get_called_class());
        $res = $db->query($sql,[':value' => $value]);
        if (empty ($res))
        {
            $e = new E404Exception('Запись с полем = ' . $column . ' знчением = ' .  $value . ' не найдена в БД!!!');
            throw $e;
        } else {
            return $res;
        }
        return false;

    }

    protected function insert()
    {
        $cols = array_keys($this->data);
        $data = [];
        foreach ($cols as $col) {
            $data[':' . $col] = $this->data[$col];
        }

        $sql = '
          INSERT INTO ' . static::$table . '
          (' . implode(', ',$cols) . ')
          VALUES
          (' . implode(', ',array_keys($data)) . ')
          ' ;

        //$this->data
        //['title' => 'Foo', 'text' => 'Bar']
        //Для подстановки надо:
        //[':title' => 'Foo', ':text' => 'Bar']

        $db = new DB();
        $db->execute($sql,$data);
        $this->article_id = $db->getLastRecID();
    }

    protected function update()
    {
        $cols = [];
        $data = [];
        foreach ($this->data as $k => $v) {
            $data[':' . $k] = $v;
            if ('article_id' == $k){
                continue;
            }
            $cols[] = $k . '=:' . $k;

        }

        $sql = 'UPDATE ' . static::$table . ' SET ' . implode(', ', $cols) .
               ' WHERE article_id=:article_id';

        $db = new DB();
        $db->execute($sql, $data);
    }

    public function delete()
    {
        $cols = array_keys($this->data);

        $data = [];
        foreach ($cols as $col) {
            $data[':' . $col] = $this->data[$col];
        }

        $sql = 'DELETE FROM ' . static::$table .
               ' WHERE article_id=:article_id';

        $db = new DB();
        $db->execute($sql, $data);
    }

    public function save()
    {

        if (!isset($this->article_id))
        {
           $this->insert();
        } else
        {
           $this->update();
        }
    }

    public function fillData($d)
    {
        foreach ($d as $key => $prop) {
            $this->data[$key] = $prop;
        }

    }

    static function checkLoginPassword ($login, $password)
    {
        return false;
    }

    static function getLoginAttempt ($login)
    {
        return false;
    }

    static function isUserBlocked ($login)
    {
        return false;
    }

    public function BlockUser ()
    {
        return true;
    }

    public function UnBlockUser ()
    {
        return true;
    }
}