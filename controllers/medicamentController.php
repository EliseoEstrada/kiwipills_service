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
            $alarmIds   = isset($data['alarmIds']) ? $data['alarmIds'] : "";
            $draft     = (isset($data['draft']) && $data['draft'] )? 1 : 0;

            $data = array(
                'user_id'       => $data['user_id'],
                'name'          => $data['name'],
                'description'   => $data['description'],
                'startDate'     => $data['startDate'] ,
                'endDate'     => $data['endDate'] ,
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
                'image'         => $image,
                'alarmIds'      => $alarmIds,
                'draft'         => $draft
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

    function getByDay(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
           
            $this->json = $this->model->getByDay($_GET['user_id'], $_GET['day']);
            echo json_encode($this->json);
        }
    }

    function delete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $this->getdataparamaters_json();
            $data = array(
                'med_id'       => $data
            );
            $this->json = $this->model->delete($data);
            echo json_encode($this->json);
        }
    }

    function getDrafts(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
           
            $this->json = $this->model->getAllDrafts($_GET['user_id']);
            echo json_encode($this->json);
        }
    }

    function publishDraft(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $this->getdataparamaters_json();
            $data = array(
                'med_id'       => $data
            );
            $this->json = $this->model->publishDraft($data);
            echo json_encode($this->json);
        }
    }

    function get(){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
           
            $this->json = $this->model->get($_GET['med_id']);
            echo json_encode($this->json);
        }
    }
    
    function edit(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $this->getdataparamaters_json();
            $data = array(
                'med_id'       => $data
            );
            $this->json = $this->model->edit($data);
            echo json_encode($this->json);
        }
    }

}