<?php

class MedicineController extends Controller{
    
    var $json;

    function __construct(){
        //Controlador padre
        parent::__construct();    
        //cargar modelo
        $this->loadModel('medicine');
        //iniciar respuesta
        $this->json = array();
    }


    function add(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            //$data = $this->getdataparamaters_json();

            $data = array(
                'name'          => $_GET['name'],
                'description'   => $_GET['description'],
                'startDate'     => $_GET['startDate'],
                'duration'      => $_GET['duration'],
                'daysInterval'  => $_GET['daysInterval'],
                'hoursInterval' => $_GET['hoursInterval'],
                'startTime'     => $_GET['startTime'],
            );

            $this->json = $this->model->add($data);
            echo json_encode($this->json);
        }
    }

}