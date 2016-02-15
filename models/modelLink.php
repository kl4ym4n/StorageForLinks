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

    public function showAllPublicLinks()
    {
        global $connection;
        $query = $connection->prepare("SELECT header, link, description, add_date FROM Links WHERE private_flag = '0'");
        $query->execute();
        $rowCount = $query->rowCount();
        if ($rowCount == 0)
        {
            echo "No public links in database";
        }
        else
        {
            //$result = $query->fetchAll();
            foreach ($query as $row)
            {
                echo "Header: {$row['header']} ".
                    "Link: {$row['link']} ". "Description: {$row['description']} ". "Creation date: {$row['add_date']} "." <br> ";

            }
        }
    }

    public function showUserLinks()
    {
        global $connection;
        $query = $connection->prepare("SELECT link, header, private_flag FROM Links WHERE user_id = '$this->userID'");
        $query->execute();
        $rowCount = $query->rowCount();
        if ($rowCount == 0)
        {
            echo "No user links in database";
        }
        else
        {
            //$result = $query->fetchAll();
            foreach ($query as $row)
            {
                echo "Header: {$row['header']} ".
                    "Link: {$row['link']} <br> ";

            }
        }
    }

    public function pagination($recLimit, $query, $rowCount)
    {
        if (isset($_GET{'page'} ))
        {
            $page = $_GET{'page'} + 1;
            $offset = $recLimit * $page ;
            echo "Page = ".$page;
        }
        else
        {
            $page = 0;
            $offset = 0;
            echo "Page = ".$page;
        }

        $pageCount = round ($rowCount / $recLimit);

        if ($page == 0)
        {
            for ($i = 1; $i < $pageCount; $i++)
            {
                $currPage = $i - 1;
                if ($i == $page - 1)
                {
                    echo "<span href= \"http://test1/Link/PublicLinks?page=$i\" >" . "$currPage </sp> " . " | ";
                }
                else
                {
                    echo "<a href= \"http://test1/Link/PublicLinks?page=$i\" >" . "$currPage </a> " . " | ";
                }
            }
            echo "<a href=\"http://test1/Link/PublicLinks?page=$page\">" . " Next $recLimit messages</a>";
            echo "</br>";
        }
    }

    public function getLinkDescription($link)
    {
        global $connection;
        $userID = $_SESSION['userID'];
        //$userID = 19;
        //echo $userID;
        $query = $connection->prepare("SELECT * FROM Links WHERE user_id = '$userID' AND link = '$link'");
        $query->execute();
        $rowCount = $query->rowCount();
        if($rowCount == 0)
        {
            echo "No such link in db";
        }
        else
        {
            $row = $query->fetchAll();
            return array("link" => $row[0]["link"], "header" => $row[0]["header"], "description" => $row[0]["description"], "flag" => $row[0]["private_flag"]);
        }
    }

    public function updateLink()
    {

    }

    public function deleteLink()
    {
        global $connection;
        $query = $connection->prepare("DELETE FROM ActivationLinks WHERE expire_time < NOW()");
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