<?php
class ControllerLink extends Controller
{
    function __construct()
    {
        $this->model = new Link();
        $this->view = new View();
    }

    public function actionAddLink()
    {
        $link = $_POST["userlink"];
        $header = $_POST["linkheader"];
        $description = $_POST["linkdescription"];
        $privateFlag = $_POST["linkflag"];
        $parameters = array("link" => $link, "header" => $header, "description" => $description, "linkflag" => $privateFlag);
        $this->model->addLink($parameters);
    }

    public function actionAddLinkPage()
    {
        $this->view->generate('viewAddLink.php', 'viewTemplate.php');
    }
}