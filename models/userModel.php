<?php 

class UserModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function signup($data){
        $result;

        try{
            $sql = "CALL sp_signup( :email, :password, :username, :name, :lastname01, :lastname02, :phone, :image)";
            
            /*
            $sql = 
                "INSERT INTO users
                SET
                email       = :email,
                password    = :password,
                username    = :username,
                name        = :name,
                lastname01  = :lastname01,
                lastname02  = :lastname02,
                phone       = :phone,
                image       = :image";
            */
 
            $connection = $this->db->connect();

            //$query = $connection->query($sql);

            $query = $connection->prepare($sql);

            if($query->execute($data)){
                $dataLogin = array(
                    'email'    => $data['email'], 
                    'password' => $data['password']
                );

                $result = $this->login($dataLogin);
            }

        }catch(PDOException $e){
            echo $e;
            $result = array(0);
        }

        return $result;
    
    }

    public function login($data){
        $result;

        try{
            $sql = "CALL sp_login( :email, :password)";
            
            /*
            $sql = 
                "SELECT id, email, password, username, name, lastname01, lastname02, phone, image
                FROM users 
                WHERE email = :email AND password = :password;";
            */
            
            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            $query->execute($data);

            if($query->rowCount() > 0){
               
                $row = $query->fetch();

                $user = array(
                    'id'         => $row['id'],
                    'email'      => $row['email'],
                    'password'   => $row['password'],
                    'username'   => $row['username'],
                    'name'       => $row['name'],
                    'lastname01' => $row['lastname01'],
                    'lastname02' => $row['lastname02'],
                    'phone'      => $row['phone'],
                    'image'      => $row['image'],
                );

                $result = $user;
            }else{
                $result = array(0);
            }

        }catch(PDOException $e){
            $result = array(0);
        }

        return $result;
    
    }


}

?>