<?php
include_once "views/viewIndex.php";
class ControllerIndex extends Controller
{
    public function actionIndex()
    {
        //$this->view->generate('viewIndex.php', 'viewTemplate.php');
        $this->view = new MainView();
        $this->view->render();
    }
}