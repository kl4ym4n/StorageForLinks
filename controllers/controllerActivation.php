<?php
class ControllerActivation extends Controller
{
    function __construct()
    {
        $this->model = new Activation();
        $this->view = new View();
    }
    public function actionVerify()
    {
        $this->view->generate('viewIndex.php', 'viewTemplate.php');
    }
    public function actionActivate()
    {
        if(isset($_GET['hash']) && !empty($_GET['hash']))
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