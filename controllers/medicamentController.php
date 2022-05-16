<?php

class MedicamentController extends Controller{
    
    var $json;

    function __construct(){
        //Controlador padre
        parent::__construct();    
        //cargar modelo
        $this->loadModel('medicament');
        //iniciar respuesta
        $this->json = array();
    }


    function add(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $this->getdataparamaters_json();

            $monday     = (isset($data['monday']) && $data['monday'] )? 1 : 0;
            $thuesday   = (isset($data['thuesday']) && $data['thuesday'] )? 1 : 0;
            $wednesday  = (isset($data['wednesday']) && $data['wednesday'] )? 1 : 0;
            $thursday   = (isset($data['thursday']) && $data['thursday'] )? 1 : 0;
            $friday     = (isset($data['friday']) && $data['friday'] )? 1 : 0;
            $saturday   = (isset($data['saturday']) && $data['saturday'] )? 1 : 0;
            $sunday     = (isset($data['sunday']) && $data['sunday'] )? 1 : 0;
            $image      = isset($data['image']) ? $data['image'] : "";

            $data = array(
                'user_id'       => $data['user_id'],
                'name'          => $data['name'],
                'description'   => $data['description'],
                'startDate'     => $data['startDate'] ,
                'startTime'     => $data['startTime'] ,
                'duration'      => $data['duration'],
                'hoursInterval' => $data['hoursInterval'],
                'monday'        => $monday,
                'thuesday'      => $thuesday,
                'wednesday'     => $wednesday,
                'thursday'      => $thursday,
                'friday'        => $friday,
                'saturday'      => $saturday,
                'sunday'        => $sunday,
                'image'         => $image
                
            );

            //echo json_encode($data);
            $this->json = $this->model->add($data);
            echo json_encode($this->json);
        }
    }

    function getAll(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
           
            $this->json = $this->model->getAll($_GET['user_id']);
            echo json_encode($this->json);
        }
    }

}