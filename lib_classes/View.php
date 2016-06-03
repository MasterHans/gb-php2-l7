<?php
namespace Application\lib_classes;

class View
    implements \Iterator, \Countable

{
    protected $data = [];
    protected $twig;

    public function __construct(){
        /*Twig*/

        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../twig_templates');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => __DIR__ . '/../twig_cache',
        ));
    }

    public function __set($k, $v){
            $this->data[$k] = $v;

    }

    public function __get($k){
        return $this->data[$k];
    }

    public function renderInside($template){

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
        echo $this->renderInside($template);
    }

    public function displayInTwig($template){
        $template = $this->twig->loadTemplate($template);

        foreach ($this->data as $key => $val) {
            $$key = $val;
        }
//        echo $template->render(array('the' => 'variables', 'go' => 'here'));

        echo $template->render(array('items'=>$$key));
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