<?php

function autoload($className)
{
    $arrayPaths = array(
        '/views/',
        '/models/',
        '/controllers/',
        '/public/'

    );

    # Count the total item in the array.
    $totalPaths = count($arrayPaths);

    # Set the class file name.
    $fileName = lcfirst($className).'.php';

    # Loop the array.
    foreach($arrayPaths as $path)
    {
        $file = sprintf('%s%s%s', __DIR__, $path, $fileName);
        if(is_file($file))
        {
            require_once $file;
            return;
            //var_dump($file);
        }

    }
}

spl_autoload_register('autoload');
