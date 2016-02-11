<?php
class Link extends GeneralModel
{
    private $userID, $link, $header, $description, $privateFlag;

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
            $query = $connection->prepare("INSERT INTO Links (user_id, link, header, description, add_date, private_flag) VALUES ('$this->userID', '$this->link', '$this->header', '$this->description', NOW(), '$this->privateFlag')");
            $query->execute();
        }
    }

    public function addLink($parameters)
    {
        //add if for variables
    }

    public function showAllPublicLinks()
    {
        global $connection;
        $query = $connection->prepare("SELECT link FROM Links WHERE private_flag = 'false'");
        $query->execute();
        $rowCount = $query->rowCount();
        if ($rowCount == 0)
        {
            echo "No public links in database";
        }
        else
        {
            $result = $query->fetchAll();
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
            $result = $query->fetchAll();
        }
    }

    public function showLinkDescription()
    {

    }

    public function deleteLink()
    {
        global $connection;
        $query = $connection->prepare("DELETE FROM ActivationLinks WHERE expire_time < NOW()");
        $query->execute();
    }


}