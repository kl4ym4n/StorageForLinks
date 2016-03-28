<?php
class Controller
{
    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
        $this->model = new GeneralModel();
    }

    function actionIndex()
    {
    }

    function allowedAction($actionName, $roleID)
    {
        $query = $this->model->getConnection()->prepare("SELECT Permissions.actions FROM Permissions WHERE role_id ='$roleID'");
        $query->execute();
        $rowCount = $query->rowCount();
        $access = false;
        foreach ($query as $result)
        {
            if ($actionName == $result['actions'])
            {
                $access = true;
            }
        }
        return $access;
    }

    function getResourceModel()
    {
        return $this->model->modelName;
    }
        //return $permissions;

}