<?php
class ControllerError extends Controller
{
    public function action404()
    {
        $this->view->generate('view404.php', 'viewTemplate.php');
        //$this->view = new ViewIndex("404");
        //$this->view->render();
    }

    public function action403()
    {
        $this->view->generate('view403.php', 'viewTemplate.php');
    }
}