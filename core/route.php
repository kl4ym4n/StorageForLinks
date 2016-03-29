<?php
class Route
{

    static function start()
    {

        // default action and controller
        $controller_name = 'index';
        $action_name = 'index';
        $permissionActionName = ucfirst($action_name);
        $loggedUser = Route::isUserLogged();

        $routes = explode('/', $_SERVER['REQUEST_URI']);
        //echo "Route[0]: $routes[0] </br>";
        //echo "Route[1]: $routes[1] </br>";
        //echo "Route[2]: $routes[2] </br>";
        //echo $routes[2];

        // controller name
        if ( !empty($routes[1]) )
        {
            $controller_name = $routes[1];
            $defaultModelName = $routes[1];
        }

        // action name
        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
            $permissionActionName = ucfirst($action_name);
        }

        // add prefix
        $model_name = 'model'.ucfirst($controller_name);
        $controller_name = 'controller'.ucfirst($controller_name);
        $action_name = 'action'.ucfirst($action_name);

//        echo "Model: $model_name </br>";
//        echo "Controller: $controller_name </br>";
//        echo "Action: $action_name </br>";

        // catch model file
        $model_file = $model_name.'.php';
        $model_path = "../models/".$model_file;
        //echo $loggedUser;
        if(file_exists($model_path))
        {
            //include "../models/".$model_file;
            if ($loggedUser == true)
            {
                //$model = new $defaultModelName;
                $user = new ModelUser();
                $userRole = $user->getUserByLogin($_SESSION['userID']);
                //echo $model->getResourceModel();
                echo "create model";
            }
            else
            {
                //echo "can't create model";
            }
        }
        else
        {
            //echo "Can't find model</br>";
        }
        // catch controller file
        $controller_file = $controller_name.'.php';
        $controller_path = "../controllers/".$controller_file;

        if(file_exists($controller_path))
        {
            include "../controllers/".$controller_file;
        }
        else
        {
            echo "Can't find controller</br>";
            Route::ErrorPage404();
        }

        // create controller
        $controller = new $controller_name;
        $action = $action_name;
        //echo $controller_name;
        if(method_exists($controller, $action))
        {
            if ($loggedUser == false)
            {
                $role = 1; //anon
            }
            else
            {
                $role = $userRole[0];
            }

            //echo $permissionActionName;
            echo $role;
            if ($controller->allowedAction($permissionActionName, $role) || $controller_name == "controllerError")
            {
                $controller->$action();
            }
            else
            {
                //echo "Forbidden";
                Route::ErrorPage403();
            }
        }
        else
        {
            //echo "Can't find actions";
            Route::ErrorPage404();
        }
    }

    function isUserLogged()
    {
        if (isset($_SESSION['userID']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function ErrorPage401()
    {
        header('HTTP/1.1 401 Unauthorized');
        header("Status: 401 Unauthorized");
        header('Location: http://test1/Error/401');
        exit;
    }

    function ErrorPage403()
    {
        header('HTTP/1.1 403 Forbidden');
        header("Status: 403 Forbidden");
        header('Location: http://test1/Error/403');
        exit;
    }

    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        //echo "Page not found";
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location: http://test1/Error/404');
        exit;
    }

}
