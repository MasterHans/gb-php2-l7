<?php
namespace Application\lib_classes;

class View
    implements \Iterator, \Countable

{
    protected $data = [];

    public function __set($k, $v){
            $this->data[$k] = $v;

    }

    public function __get($k){
        return $this->data[$k];
    }

    public function render($template){

        foreach ($this->data as $key => $val) {
            $$key = $val;

        }
        ob_start();
        include __DIR__ . '/../views/' . $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function display($template){
        echo $this->render($template);
    }

    public function current()
    {
        return current($this->data);
    }


    public function next()
    {
        next($this->data);
    }


    public function key()
    {
        return key($this->data);
    }


    public function valid()
    {
        return array_key_exists(key($this->data), $this->data);
    }

    public function rewind()
    {
        reset($this->data);
    }

    public function count()
    {
        return count($this->data);
    }
}