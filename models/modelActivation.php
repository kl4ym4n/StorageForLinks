<?php
class Activation extends GeneralModel
{
    private $userID, $linkHash, $expireTime;

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function setLinkHash($linkHash)
    {
        $this->linkHash = $linkHash;
    }

    public function getLinkHash()
    {
        return $this->linkHash;
    }

    public function setExpireTime($linkExpireTime)
    {
        $this->expireTime = $linkExpireTime;
    }

    public function getExpireTime()
    {
        return $this->expireTime;
    }

    function __construct()
    {

    }

    public function fillFields($params)
    {
        $this->setUserID($params["uid"]);
        $this->setLinkHash($params["hash"]);
        $this->setExpireTime($params["expireTime"]);
    }

    public function addActivationPropertiesToDB()
    {
        //global $connection;
        $query = $this->connection->prepare("INSERT INTO ActivationLinks (uid, link_hash, expire_time) VALUES ('$this->userID', '$this->linkHash', '$this->expireTime')");
        $query->execute();
    }

    public function activateUser($parameters)
    {
        //global $connection;
        $userhash = $parameters["hash"];
        $query = $this->connection->prepare("SELECT uid, expire_time FROM ActivationLinks WHERE link_hash = '$userhash'");
        $query->execute();
        $rowCount = $query->rowCount();
        if($rowCount > 0)
        {
            $row = $query->fetchAll();
            $resultID = $row[0]["uid"];
            $query = $this->connection->prepare("UPDATE Users SET status = '1' WHERE primary_key = '$resultID' AND status = '0'");
            $query->execute();
            $updateRowCount = $query->rowCount();
            if ($updateRowCount > 0)
            {
                echo "Success activation!";
            }
            else
            {
                echo "Your account have already activated!";
            }

        }
        else
        {
            echo "Invalid url or your account have already activated!";
        }
    }
}

