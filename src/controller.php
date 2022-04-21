<?php

class Controller{

    function __construct(){
        
    }

    function loadModel($model){
        
        $clasModel = $model . 'Model';
        $file = 'models/'. $clasModel . '.php';

        if(file_exists($file)){
            require_once $file;
            $this->model = new $clasModel();
        }
        
    }

    function getdataparamaters_json(){
	    $json_params = file_get_contents("php://input");
	    $json_params  = utf8_encode($json_params);
	    $data = json_decode( $json_params, true  );
	    return $data;
	} 
}

?>