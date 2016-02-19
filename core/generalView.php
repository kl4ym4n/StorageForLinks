<?php
class View
{
    public $template;
    public $args = array();

    public function _toString()
    {
        ob_start();

        ob_end_clean();
    }

    public function render()
    {

    }

    public function setParameters()
    {

    }

    function generate($content_view, $template_view, $data = null)
    {
        include 'views/'.$template_view;
    }
}