<?php

class Controller{

    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    //function to load a model in any controller, this is because not all controllers need a model, so call it as you need
    function loadModel($model){
        $url = 'models/' . $model . 'model.php';

        //check if the called model exists
        if(file_exists($url)){
            require $url;

            //i do not understand very well how the model is called, i am a bit tired
            $modelName = $model.'Model';
            $this->model = new $modelName();

        }
    }
}

?>