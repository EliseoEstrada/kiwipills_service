<?php

require_once 'autoload.php';
require_once 'config/parameters.php';
require_once 'src/database.php';
require_once 'src/controller.php';
require_once 'src/model.php';


$classController = "";
$action = "";

//CONTROLADOR
if(isset($_GET['controller'])){
    //Sí existe el controlador
    $classController = $_GET['controller'].'Controller';
}else{
    // Si no existe, llame la función de errores
    exit();
}


//ACCION
// comprobando que el controlador exista

if(isset($classController) && class_exists($classController)){

    //Creo un nuevo objeto de la clase controladora
    $controller = new $classController();

    
    // Invocando los métodos automáticamente
    if(isset($_GET['action'])){
        if(method_exists($controller, $_GET['action'])){
            $action = $_GET['action'];
            $controller->$action();
        }else{
            exit();
        }
    }
    else{
        exit();
    }
}else{    
    exit();
}


?>