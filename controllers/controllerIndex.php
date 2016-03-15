<?php
class ControllerIndex extends Controller
{
    public function actionIndex()
    {
        $this->view = new ViewIndex("Main");
        $this->view->render();
    }
}