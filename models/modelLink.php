<?php
session_start();
class Link extends GeneralModel
{
    private $userID, $link, $header, $description, $creationDate, $privateFlag;

    public function addLinkToDB()
    {
        global $connection;
        $query = $connection->prepare("SELECT user_id, link FROM  Links WHERE link = '$this->link' AND user_id = '$this->userID'");
        $result = $query->rowCount();
        if ($result > 0)
        {
            echo "Link already exist!";
        }
        else
        {
            $this->creationDate = $this->getCurrentDateTime();
            $query = $connection->prepare("INSERT INTO Links (user_id, link, header, description, add_date, private_flag) VALUES ('$this->userID', '$this->link', '$this->header', '$this->description', '$this->creationDate', '$this->privateFlag')");
            $query->execute();
        }
    }

    public function fillFields($parameters)
    {
        $this->userID = $_SESSION['userID'];
        $this->link = $parameters['link'];
        $this->header = $parameters['header'];
        $this->description = $parameters['description'];
        $this->privateFlag = $parameters['linkflag'];
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
        global $connection;
        $recLimit = 2;
        $data = array();
        $linkID = array();
        $queryCount = $connection->prepare("SELECT primary_key FROM Links WHERE private_flag = '0'");
        $queryCount->execute();
        $rowCount = $queryCount->rowCount();
        $pageCount = round ($rowCount / $recLimit);
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
        $query = $connection->prepare("SELECT primary_key, header, link, private_flag FROM Links  WHERE private_flag = '0' LIMIT $offset, $recLimit");
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

    public function showUserLinks()
    {
        global $connection;
        $recLimit = 2;
        $data = array();
        $linkID = array();
        $queryCount = $connection->prepare("SELECT primary_key FROM Links WHERE private_flag = '0'");
        $queryCount->execute();
        $rowCount = $queryCount->rowCount();
        $pageCount = round ($rowCount / $recLimit);
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
        $query = $connection->prepare("SELECT link, header, private_flag FROM Links WHERE user_id = '$this->userID' LIMIT $offset, $recLimit");
        $query->execute();
        //$rowCount = $query->rowCount();
        if ($rowCount == 0)
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
                //$i++;
                $linkID[] = $result['primary_key'];

            }
        }
        $params = array($linkID, $data, $page, $pageCount, $recLimit);
        return $params;
    }

    public function getLinkDescription($userID, $linkID)
    {
        global $connection;
        //$userID = $_SESSION['userID'];
        //$userID = 19;
        //echo $userID;
        $query = $connection->prepare("SELECT * FROM Links WHERE user_id = '$userID' AND primary_key = '$linkID'");
        $query->execute();
        $rowCount = $query->rowCount();
        if($rowCount == 0)
        {
            echo "No such link in db";
        }
        else
        {
            $row = $query->fetchAll();
            return array("id" => $row[0]['primary_key'], "link" => $row[0]["link"], "header" => $row[0]["header"], "description" => $row[0]["description"], "flag" => $row[0]["private_flag"]);
        }
    }

    public function getPublicLinkDescription($linkID)
    {
        global $connection;
        $query = $connection->prepare("SELECT * FROM Links WHERE primary_key = '$linkID'");
        $query->execute();
        $rowCount = $query->rowCount();
        if($rowCount == 0)
        {
            echo "No such link in db";
        }
        else
        {
            $row = $query->fetchAll();
            return array("id" => $row[0]['primary_key'], "link" => $row[0]["link"], "header" => $row[0]["header"], "description" => $row[0]["description"], "flag" => $row[0]["private_flag"]);
        }
    }

    public function updateLink($parameters, $userID, $linkID)
    {
        global $connection;
        //$userID = $_SESSION['userID'];
        //$userID = 19;
        //$linkID = 5;
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
            //echo $flag;
            $query = $connection->prepare("UPDATE Links SET header =  '$header', link = '$link', description = '$description', private_flag = '$flag' WHERE user_id = '$userID' AND primary_key = $linkID");
            $query->execute();
        }
    }

    public function deleteLink($userID, $linkID)
    {
        global $connection;
        //$userID = 19;
        //$linkID = 5;
        $query = $connection->prepare("DELETE FROM Links WHERE user_id = '$userID' AND primary_key = $linkID");
        $query->execute();
    }

    public function getCurrentDateTime()
    {
        date_default_timezone_set("Asia/Novosibirsk");
        $dt = time();
        $time = date("Y-m-d h:i:s",$dt);
        return $time;
    }

}