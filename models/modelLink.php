<?php
//session_start();
class ModelLink extends GeneralModel
{
    private $userID, $link, $header, $description, $creationDate, $privateFlag;

    public function __construct()
    {
        $this->connection = Boot::getConnection();
        $this->modelName = "ModelLink";
    }

    public function addLinkToDB()
    {
        //global $connection;
        $userID = $_SESSION['userID'];
        $query = $this->connection->prepare("SELECT user_id, link FROM  Links WHERE link = '$this->link' AND user_id = '$userID'");
        $result = $query->rowCount();
        if ($result > 0)
        {
            echo "Link already exist!";
        }
        else
        {
            $this->creationDate = $this->getCurrentDateTime();
            $query = $this->connection->prepare("INSERT INTO Links (user_id, link, header, description, add_date, private_flag) VALUES ('$this->userID', '$this->link', '$this->header', '$this->description', '$this->creationDate', '$this->privateFlag')");
            $query->execute();
        }
    }

    public function fillFields($parameters)
    {
        if (isset($_SESSION['userID']))
        {
            $this->userID = $_SESSION['userID'];
            $this->link = $parameters['link'];
            $this->header = $parameters['header'];
            $this->description = $parameters['description'];
            $this->privateFlag = $parameters['linkflag'];
        }
        else
        {
            echo "You need to sign in first!";
        }
    }

    public function addLink($parameters)
    {
        if ($parameters["header"] == NULL || $parameters["link"] == NULL || $parameters["description"] == NULL)
        {
            echo "Please, fill empty fields!";
        }
        else
        {
            $this->fillFields($parameters);
            $this->addLinkToDB();
        }
    }

    public function getAllPublicLinks()
    {
        //global $connection;
        $recLimit = 2;
        $data = array();
        $linkID = array();
        $queryCount = $this->connection->prepare("SELECT primary_key FROM Links WHERE private_flag = '0'");
        $queryCount->execute();
        $rowCount = $queryCount->rowCount();
        $pageCount = ceil ($rowCount / $recLimit);
        if (isset($_GET{'page'} ))
        {
            $page = $_GET{'page'};
            $offset = $recLimit * $page ;
        }
        else
        {
            $page = 0;
            $offset = 0;
        }
        $query = $this->connection->prepare("SELECT primary_key, header, link, private_flag FROM Links  WHERE private_flag = '0' LIMIT $offset, $recLimit");
        $query->execute();
        if ($rowCount == 0)
        {
            echo "No public links in database";
        }
        else
        {
            foreach ($query as $result)
            {
//                $row = array("id" => $result['primary_key'], "link" => $result['link'], "header" => $result['header'],
//                    "description" => $result['description'], "flag" => $result['private_flag'], "date" => $result['add_date']);
                $row = array("header" => $result['header'], "link" => $result['link']);
                $data[] = $row;
                $linkID[] = $result['primary_key'];
            }
        }
        $params = array($linkID, $data, $page, $pageCount, $recLimit);
        return $params;
    }

    public function getAllLinks()
    {
        //global $connection;
        $recLimit = 2;
        $data = array();
        $linkID = array();
        $queryCount = $this->connection->prepare("SELECT primary_key FROM Links");
        $queryCount->execute();
        $rowCount = $queryCount->rowCount();
        $pageCount = ceil ($rowCount / $recLimit);
        if (isset($_GET{'page'} ))
        {
            $page = $_GET{'page'};
            $offset = $recLimit * $page ;
        }
        else
        {
            $page = 0;
            $offset = 0;
        }
        $query = $this->connection->prepare("SELECT primary_key, header, link, private_flag FROM Links LIMIT $offset, $recLimit");
        $query->execute();
        if ($rowCount == 0)
        {
            echo "No links in database";
        }
        else
        {
            foreach ($query as $result)
            {
                $row = array("header" => $result['header'], "link" => $result['link']);
                $data[] = $row;
                $linkID[] = $result['primary_key'];
            }
        }
        $params = array($linkID, $data, $page, $pageCount, $recLimit);
        return $params;
    }

    public function getUserLinks()
    {
        //global $connection;
        $recLimit = 2;
        $data = array();
        $linkID = array();
        $params = array();
        if (isset($_SESSION['userID']))
        {
            $userID = $_SESSION['userID'];
        }
        else
        {
            $userID = -1;
        }
        $queryCount = $this->connection->prepare("SELECT primary_key FROM Links WHERE user_id = '$userID'");
        $queryCount->execute();
        $rowCount = $queryCount->rowCount();
        $pageCount = ceil ($rowCount / $recLimit);
        if (isset($_GET{'page'} ))
        {
            $page = $_GET{'page'};
            $offset = $recLimit * $page ;
        }
        else
        {
            $page = 0;
            $offset = 0;
        }
        $query = $this->connection->prepare("SELECT primary_key, link, header, private_flag, description, private_flag, add_date FROM Links WHERE user_id = '$userID' LIMIT $offset, $recLimit");
        $query->execute();
        $finalRowCount = $query->rowCount();
        //echo $userID;
        if ($finalRowCount == 0)
        {
            echo "No user links in database";
        }
        else
        {
            //$result = $query->fetchAll();
            foreach ($query as $result)
            {
                $row = array("link" => $result['link'], "header" => $result['header'],
                    "description" => $result['description'], "flag" => $result['private_flag'], "date" => $result['add_date']);
                $data[] = $row;
                $linkID[] = $result['primary_key'];
            }
            $params = array($linkID, $data, $page, $pageCount, $recLimit);
        }

        return $params;
    }

    public function getLinkDescription($linkID)
    {
        //global $connection;
        $params = array();
        $query = $this->connection->prepare("SELECT * FROM Links WHERE primary_key = '$linkID'");
        $query->execute();
        $rowCount = $query->rowCount();
        if($rowCount == 0)
        {
            echo "No such link in db";
        }
        else
        {
            $row = $query->fetchAll();
            $params = array("id" => $row[0]['primary_key'], "link" => $row[0]["link"], "header" => $row[0]["header"], "description" => $row[0]["description"], "flag" => $row[0]["private_flag"]);
        }
        return $params;
    }

//    public function getPublicLinkDescription($linkID)
//    {
//        //global $connection;
//        $params = array();
//        $query = $this->connection->prepare("SELECT * FROM Links WHERE primary_key = '$linkID'");
//        $query->execute();
//        $rowCount = $query->rowCount();
//        if($rowCount == 0)
//        {
//            echo "No such link in db";
//        }
//        else
//        {
//            $row = $query->fetchAll();
//            $params = array("id" => $row[0]['primary_key'], "link" => $row[0]["link"], "header" => $row[0]["header"], "description" => $row[0]["description"], "flag" => $row[0]["private_flag"]);
//        }
//        return $params;
//    }

    public function updateLink($parameters, $linkID)
    {
        //global $connection;
        if ($parameters["link"] == NULL || $parameters["description"] == NULL || $parameters["header"] == NULL)
        {
            echo "Please, fill empty fields!";
        }
        else
        {
            $header = $parameters["header"];
            $link = $parameters["link"];
            $description = $parameters["description"];
            $flag = $parameters["flag"];
            $query = $this->connection->prepare("UPDATE Links SET header =  '$header', link = '$link', description = '$description', private_flag = '$flag' WHERE primary_key = $linkID");
            $query->execute();
        }
    }

    public function deleteLink($linkID)
    {
        //global $connection;
        //echo $linkID;
        if (isset($_SESSION['userID']))
        {
            $query = $this->connection->prepare("DELETE FROM Links WHERE primary_key = $linkID");
            $query->execute();
        }
        else
        {
            echo "You can't delete this link!";
        }

    }

    public function getCurrentDateTime()
    {
        date_default_timezone_set("Asia/Novosibirsk");
        $dt = time();
        $time = date("Y-m-d h:i:s",$dt);
        return $time;
    }

}