<?php

require_once 'controllers/error.php';

class App
{

    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url,'/');
        $url = explode('/',$url);

        //extra condition: if u call an empty url, send to the index
        if(empty($url[0])){
            $fileController = 'controllers/main.php';
            require_once $fileController;
            $controller = new Main();
            $controller->loadModel('main');
            $controller->render();
            return false;
        }

        //incoming url
        $fileController = 'controllers/' . $url[0] . '.php';

        //test if the page you are trying to reach is available
        if(file_exists($fileController)){
            require_once $fileController;

            //initialize controller and load model
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            //test if the method exists in the controller
            if(isset($url[1])){
                $controller->{$url[1]}();
            }else{
                $controller->render();
            }

        }else{
            $controller = new ErrorHandler();
        }
    }
}

?>
