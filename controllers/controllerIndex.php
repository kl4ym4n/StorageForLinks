<?php
class ControllerIndex extends Controller
{
    public function actionIndex()
    {
        //$this->view->generate('viewIndex.php', 'viewTemplate.php');
        $this->view = new ViewIndex();
        $this->view->render();
    }
}