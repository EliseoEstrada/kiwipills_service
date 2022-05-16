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
            $image = isset($data['image']) ? $data['image'] : "";

            $data = array(
                'email'         => $data['email'], 
                'password'      => $data['password'],
                'username'      => $data['username'],
                'name'          => $name,
                'lastname01'    => $lastname01,
                'lastname02'    => $lastname02,
                'phone'         => $phone,
                'image'         => $image
            );

            $data2 = array(
                'email'         => $data['email']
            );

            $check = $this->model->check_user($data2);
            if($check == 0){
                $this->json = $this->model->signup($data);
            } else{
                $this->json = array('error','error');
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

    function editProfile(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $data = $this->getdataparamaters_json();

            $data = array(
                'password'   => $data['password'],
                'username'   => $data['username'],
                'name'       => $data['name'],
                'lastname01' => $data['lastname01'],
                'lastname02' => $data['lastname02'],
                'phone'      => $data['phone'],
                'image'      => $data['image']
            );

            $this->json = $this->model->edit_profile($data);
            echo json_encode($this->json);
        }
    }

}