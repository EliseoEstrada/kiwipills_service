<?php

class UserController extends Controller{
    
    var $json;

    function __construct(){
        //Controlador padre
        parent::__construct();    
        //cargar modelo
        $this->loadModel('user');
        //iniciar respuesta
        $this->json = array();
    }

    function signup(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
            $data = $this->getdataparamaters_json();

            $name = isset($data['name']) ? $data['name'] : "";
            $lastname01 = isset($data['lastname01']) ? $data['lastname01'] : "";
            $lastname02 = isset($data['lastname02']) ? $data['lastname02'] : "";
            $phone = isset($data['phone']) ? $data['phone'] : "";

            $data = array(
                'email'         => $data['email'], 
                'password'      => $data['password'],
                'username'      => $data['username'],
                'name'          => $name,
                'lastname01'    => $lastname01,
                'lastname02'    => $lastname02,
                'phone'         => $phone
            );

            $data2 = array(
                'email'         => $data['email']
            );


            if(!$this->model->check_user($data2)){
                $this->json = $this->model->signup($data);
            } else{
                $this->json = array(0);
            }
            echo json_encode($this->json);

        }

    }


    function login(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $this->getdataparamaters_json();

            $data = array(
                'email'    => $data['email'], 
                'password' => $data['password']
            );

            $this->json = $this->model->login($data);
            echo json_encode($this->json);
        }
    }

}