<?php
class View
{
    public $template;
    public $args = array();

    public function __toString()
    {
        ob_start();
        $this->render();
        return ob_get_clean();
    }

    public function render()
    {
        print call_user_func_array('sprintf', array_merge(array($this->template), $this->args));
    }

    public function setParameters()
    {
        
    }

    function generate($content_view, $template_view, $data = null)
    {
        include 'views/'.$template_view;
    }
}