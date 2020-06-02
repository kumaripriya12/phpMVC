<?php

    $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';

    $requestedController = $url[0]; 

    $requestedAction = isset($url[1])? $url[1] :'';

    if(isset($url[2])){
    	$requestedParams = $url[2]; 
    } else {
    	echo "Please provide a valid string";
    	exit();
    }
    
    $ctrlPath = __DIR__.'/Controllers/'.$requestedController.'.php';

    if (file_exists($ctrlPath))
    {
    	require_once("config.php");
        require_once __DIR__.'/Controllers/'.$requestedController.'.php';
        

        $controllerName = ucfirst($requestedController);

        $controllerObj  = new $controllerName( $requestedParams );    
        echo $controllerObj->$requestedAction();    

    }else{

        header('HTTP/1.1 404 Not Found');
        die('404 - The file - '.$ctrlPath.' - not found');
    }
?>