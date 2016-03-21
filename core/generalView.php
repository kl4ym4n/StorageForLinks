<?php
class View
{
    public $template;
    public $args = array();
    protected $data;
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

    public function setParameters($params)
    {
        $this->data = $params;
        //echo $this->data[0]['header'];
    }

    function generate($content_view, $template_view, $data = null)
    {
        include 'views/'.$template_view;
    }

    function echoActiveClass($requestUri)
    {
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        $current_file_name = '';
        if (isset($routes[2]))
        {
            $current_file_name = $routes[2];
        }
        else
        {
            if ($requestUri == '/index')
            {
                $current_file_name = $requestUri;
            }
        }
        if ($current_file_name == $requestUri)
        {
            return 'class="active"';
        }

        else
        {
            return '';
        }
    }

    function setSelectedItem($userRole, $roleID)
    {
        if ($userRole == $roleID)
        {
            return "selected";
        }
        else
        {
            return "";
        }
    }
}