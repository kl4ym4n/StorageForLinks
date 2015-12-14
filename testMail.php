<?php
require 'libraries/PHPMailerAutoload.php';
require 'libraries/config.php';


class Mailer extends PHPMailer
{

    var $to_name;
    var $to_email;
    var $From = null;
    var $FromName = null;
    var $Sender = null;

    function Mailer()
    {
        global $mailer_config;

        if($mailer_config['smtp_mode'] == 'enabled')
        {
            $this->Host = $mailer_config['smtp_host'];
            $this->Port = $mailer_config['smtp_port'];
            $this->SMTPDebug  = 1;
            //echo "enabled";
            if($mailer_config['smtp_username'] != '')
            {
                $this->SMTPAuth  = true;
                $this->Username  = $mailer_config['smtp_username'];
                $this->Password  =  $mailer_config['smtp_password'];
                //echo "username";
            }
            //$this->SMTPAuth  = true;
            $this->Mailer = "smtp";
        }
        if(!$this->From)
        {
            $this->From = $mailer_config['from_email'];
        }
        if(!$this->FromName)
        {
            $this-> FromName = $mailer_config['from_name'];
        }
        if(!$this->Sender)
        {
            $this->Sender = $mailer_config['from_email'];
        }

    }
}

$sender = new Mailer();

$sender->Subject = 'Registration';

$sender->Body = 'Ololo';

$sender->AddAddress('kl4ym4n@gmail.com', "First");

if(!$sender->Send())
{
    echo 'Cannot send letter!';
}
else
{
    echo 'Letter sended!';
}
$sender->ClearAddresses();
$sender->ClearAttachments();