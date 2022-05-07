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
                //$response = array('result', 'success user added');
                $result = $user;
            }else{
                $result = array('result', 'error');
            }

        }catch(PDOException $e){
            $result = array('error', $e);
        }
        //echo json_encode($response);
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
                
                //$response = array('response', 'user logged in');
                $result = $user;
            }else{
                $result = array('response', 'user not logged in');
                //$result = array(0);
            }

        }catch(PDOException $e){
            $result = array('response', 'server error');
            //$result = array(0);
        }
        //echo json_encode($response);
        return $result;
    
    }

    public function check_user($data2){
        $result=true;

        try{
            $sql = "CALL sp_check_user( :email)";
            $connection = $this->db->connect();
            $query = $connection->prepare($sql);
            $query->execute($data2);

            if($query->rowCount() > 0){
                $response = array('response', 'user exists');
                $result = true;
            }else{
                $response = array('response', 'success user doesnt exists');
                $result = false;
            }

        }catch(PDOException $e){
            $response = array('response', $e);
            $result = true;
        }
        //echo json_encode($response);
        return $result;
    
    }


}

?>