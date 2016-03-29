<?php
class ControllerActivation extends Controller
{
    public function __construct()
    {
        $params = array();
        $this->model = new ModelActivation($params);
        $this->view = new View();
    }
    public function actionVerify()
    {
        $this->view = new ViewIndex("Main");
        $this->view->render();
        //$this->view->generate('viewIndex.php', 'viewTemplate.php');
    }

    public function actionActivationResend()
    {

    }

    public function actionActivate()
    {
        if(isset($_GET['hash']))
        {
            //echo "ok!";
            //echo $_GET['email'];
            //echo $_GET['login'];
            $hash = $_GET['hash'];
            $parameters = array("hash" => $hash);
            $this->model->activateUser($parameters);
        }
        else
        {
            // Invalid approach
            echo "Invalid approach! Please use the link that has been send to your email";
        }
    }
}