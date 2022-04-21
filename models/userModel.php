<?php 

class UserModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function signup($data){
        $result;

        try{
            $sql = "CALL sp_signup( :email, :password, :username, :name, :lastname01, :lastname02, :phone)";
            //$sql = "SELECT id, email, password, username FROM users WHERE email = '".$data['email']."' AND password = '".$data['password']."'";
 
            $connection = $this->db->connect();

            //$query = $connection->query($sql);

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
                );

                $result = $user;
            }else{
                $result = array(0);
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