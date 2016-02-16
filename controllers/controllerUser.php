<?php
class ControllerUser extends Controller
{
    function __construct()
    {
        $this->model = new User();
        $this->view = new View();
    }

    public function actionRegistrationPage()
    {
        $this->view->generate('viewRegist.php', 'viewTemplate.php');
    }

    public function actionRegistration()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $mail = $_POST['mail'];
        $username = $_POST['username'];
        $surname = $_POST['surname'];
        $params = array("login" => $login, "password" => $password, "repassword" => $repassword, "mail" => $mail, "username" => $username, "surname" => $surname);
        $this->model->registerUser($params);
        $this->view->generate('viewRegist.php', 'viewTemplate.php');
    }

    public function actionLoginPage()
    {
        $this->view->generate('viewLogin.php', 'viewTemplate.php');
    }

    public function actionLogin()
    {
        $userlogin = $_POST['userlogin'];
        $userpassword = $_POST['userpassword'];
        $parameters = array("userlogin" => $userlogin, "userpassword" => $userpassword);
        $this->model->checkUserLogin($parameters);
        $this->view->generate('viewLogin.php', 'viewTemplate.php');
    }

    public function actionViewAllUsers()
    {

    }

    public function actionViewProfile()
    {
        $data = $this->model->getUserProfile();
        $this->view->generate('viewEditProfile.php', 'viewTemplate.php', $data);
    }

    public function actionUpdateProfile()
    {
        $password = $_POST['password'];
        $mail = $_POST['mail'];
        $username = $_POST['username'];
        $surname = $_POST['surname'];
        $params = array("password" => $password, "mail" => $mail, "username" => $username, "surname" => $surname);
        $this->model->updateUserProfile($params);
        $data = $this->model->getUserProfile();
        $this->view->generate('viewEditProfile.php', 'viewTemplate.php', $data);
    }
}