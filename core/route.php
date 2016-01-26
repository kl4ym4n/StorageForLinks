<?php

class Route
{

    static function start()
    {
        // default action and controller
        $controller_name = 'index';
        $action_name = 'index';

       $routes = explode('/', $_SERVER['REQUEST_URI']);
        echo "Route[0]: $routes[0] </br>";
        echo "Route[1]: $routes[1] </br>";
        //echo "Route[2]: $routes[2] </br>";
       //echo $routes[2];

        // controller name
        if ( !empty($routes[1]) )
        {
            echo "1</br>";
            $controller_name = $routes[1];
        }

        // action name
        if ( !empty($routes[2]) )
        {
            echo "2</br>";
            $action_name = $routes[2];
        }

        // add prefix
        $model_name = 'model'.ucfirst($controller_name);
        $controller_name = 'controller'.ucfirst($controller_name);
        //$controller_name = $controller_name;
        $action_name = 'action'.ucfirst($action_name);


        echo "Model: $model_name <br>";
        echo "Controller: $controller_name <br>";
        echo "Action: $action_name <br>";


        // catch model file

        $model_file = $model_name.'.php';
        $model_path = "models/".$model_file;
        echo $model_path;
        if(file_exists($model_path))
        {
            //include "models/".$model_file;
        }

        // catch controller file
        $controller_file = $controller_name.'.php';
        $controller_path = "controllers/".$controller_file;

        if(file_exists($controller_path))
        {
            include "controllers/".$controller_file;
        }
        else
        {
            echo "Can't find controller";
            //Route::ErrorPage404();
        }

        // create controller
        $controller = new $controller_name;
        $action = $action_name;
        //echo "$action.'1' </br>";
        //echo $controller_name;
        if(method_exists($controller, $action))
        {
            $controller->$action();
        }
        else
        {
            //echo $action;
            echo "Can't find actions";
            //Route::ErrorPage404();
        }

    }

    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }

}
