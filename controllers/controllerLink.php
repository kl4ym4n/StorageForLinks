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
        if (isset($_SESSION['userID']) && $_SESSION['userID'] == true)
        {
            $link = $_POST["userlink"];
            $header = $_POST["linkheader"];
            $description = $_POST["linkdescription"];
            $privateFlag = $_POST["linkflag"];
            $parameters = array("link" => $link, "header" => $header, "description" => $description, "linkflag" => $privateFlag);
            $this->model->addLink($parameters);
        }
        else
        {
            echo "You need to sign in first!";
        }
        $this->view = new ViewIndex("AddLink");
        $this->view->render();
    }

    public function actionAddLinkPage()
    {
        $this->view = new ViewIndex("AddLink");
        $this->view->render();
    }

    public function actionPublicLinks()
    {
        $data = $this->model->getAllPublicLinks();
        if ($data != null)
        {
            $this->view = new ViewIndex("PublicLinks", $data);
            $this->view->render();
            //$this->view->generate('viewPublicLinks.php', 'viewTemplate.php');
        }
    }

    public function actionUserLinks()
    {
        $data = $this->model->getUserLinks();
        if ($data != null)
        {
            $this->view = new ViewIndex("UserLinks", $data);
            $this->view->render();
        }
    }

    public function actionAllLinks()
    {
        $data = $this->model->getAllLinks();
        if ($data != null)
        {
            $this->view = new ViewIndex("AllLinks", $data);
            $this->view->render();
        }
    }

    public function actionViewUserLink()
    {
        if(isset($_GET['linkid']) && isset($_SESSION['userID']))
        {

            $linkID = $_GET['linkid'];
            $userID = $_SESSION['userID'];
            $data = $this->model->getLinkDescription($userID, $linkID);
            if ($data != null)
            {
                $this->view = new ViewIndex("LinkInfo", $data);
                $this->view->render();
            }
        }
        else
        {
            echo "Invalid link!";
        }
    }

    public function actionViewPublicLink()
    {
        if(isset($_GET['linkid']))
        {

            $linkID = $_GET['linkid'];
            $data = $this->model->getPublicLinkDescription($linkID);
            if ($data != null)
            {
                $this->view = new ViewIndex("LinkInfo", $data);
                $this->view->render();
            }
        }
        else
        {
            echo "Invalid link!";
        }
    }

    public function actionViewEditLink()
    {
        if(isset($_GET['linkid'])) {

            $linkID = $_GET['linkid'];
            $data = $this->model->getPublicLinkDescription($linkID);
            if ($data != null)
            {
                $this->view = new ViewIndex("EditLink", $data);
                $this->view->render();
            }
        }
    }

    public function actionDeleteLink()
    {
        if(isset($_GET['linkid']))
        {
            //$linkID = 5;
            //$userID = 19;
            //$this->model->deleteLink($userID, $linkID);
        }
    }

    public function actionEditLink()
    {
        if(isset($_GET['linkid']))
        {
            $header = $_POST["linkheader"];
            $link = $_POST["userlink"];
            $description = $_POST["linkdescription"];
            $flag = $_POST["linkflag"];
            $params = array("header" => $header, "link" => $link, "description" => $description, "flag" => $flag);
            $linkID = $_GET['linkid'];
            $userID = 19;
            $this->model->updateLink($params, $userID, $linkID);
            $data = $this->model->getLinkDescription($userID, $linkID);
            if ($data != null)
            {
                $this->view = new ViewIndex("LinkInfo", $data);
                $this->view->render();
            }

        }
    }
}