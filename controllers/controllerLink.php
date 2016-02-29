<?php
class ControllerLink extends Controller
{
    public function __construct()
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
        $this->view = new ViewIndex("AddLink");
        $this->view->render();
        //$this->view->generate('viewAddLink.php', 'viewTemplate.php');
    }

    public function actionPublicLinks()
    {
        $this->model->showAllPublicLinks();
        $this->view = new ViewIndex("PublicLinks");
        $this->view->render();
        //$this->view->generate('viewPublicLinks.php', 'viewTemplate.php');
    }

    public function actionViewLink()
    {
        $linkID = 5;
        $userID = 19;
        $data = $this->model->getLinkDescription($userID, $linkID);
        $this->view->generate('viewLinkDescription.php', 'viewTemplate.php', $data);
    }

    public function actionViewEditLink()
    {
        $linkID = 5;
        $userID = 19;
        $data = $this->model->getLinkDescription($userID, $linkID);
        $this->view->generate('viewEditLink.php', 'viewTemplate.php', $data);
    }

    public function actionDeleteLink()
    {
        $linkID = 5;
        $userID = 19;
        $this->model->deleteLink($userID, $linkID);
    }

    public function actionEditLink()
    {
        $header = $_POST["linkheader"];
        $link = $_POST["userlink"];
        $description = $_POST["linkdescription"];
        $flag = $_POST["linkflag"];
        $params = array("header" => $header, "link" => $link, "description" => $description, "flag" => $flag);
        $linkID = 5;
        $userID = 19;
        $this->model->updateLink($params, $userID, $linkID);
        //$linkID = 5;
        $data = $this->model->getLinkDescription($userID, $linkID);
        $this->view->generate('viewEditLink.php', 'viewTemplate.php', $data);
    }
}