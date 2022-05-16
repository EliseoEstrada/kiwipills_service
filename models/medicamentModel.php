<?php 

class MedicamentModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function add($data){
        $result;

        try{

            $sql = "CALL sp_addMedicament(
                :user_id,
                :name, 
                :description, 
                :startDate, 
                :startTime, 
                :duration, 
                :hoursInterval,
                :monday,
                :thuesday,      
                :wednesday,     
                :thursday,      
                :friday,        
                :saturday,      
                :sunday,        
                :image
            )";   

            $connection = $this->db->connect();
            $query = $connection->prepare($sql);

            if($query->execute($data)){
                $result = 1;
            }else{
                $result = 0;
            }

        }catch(PDOException $e){
            echo $e;
            $result = 0;
        }

        return $result;
    
    }
    
     function getAll($user_id){

        $items = [];
        
        try{

            //$sql = "SELECT * FROM medicaments WHERE user_id = (?) ";
            $sql = "CALL sp_getAllMedicaments((?))";
            $connection = $this->db->connect();

            $query = $connection->prepare($sql);
            $query->bindValue(1, $user_id);

            $query->execute();
            
            if($query->rowCount() > 0){
                
                while($row = $query->fetch()){
                    //$item = $row;
                    
                    $item = array(
                        'id'            => $row['id'],
                        'user_id'       => $row['user_id'],
                        'name'          => $row['name'],
                        'description'   => $row['description'],
                        'startDate'     => $row['startDate'],
                        'startTime'     => $row['startTime'],
                        'duration'      => $row['duration'],
                        'hoursInterval' => $row['hoursInterval'],
                        'monday'        => ($row['monday'] == 1) ? true : false,
                        'thuesday'      => ($row['thuesday'] == 1) ? true : false,
                        'wednesday'     => ($row['wednesday'] == 1) ? true : false,
                        'thursday'      => ($row['thursday'] == 1) ? true : false,
                        'friday'        => ($row['friday'] == 1) ? true : false,
                        'saturday'      => ($row['saturday'] == 1) ? true : false,
                        'sunday'        => ($row['sunday'] == 1) ? true : false,
                        'image'         => $row['image']
                
                    );
                    
                    array_push($items, $item);
                }
                
                //var_dump($items);
            }

        }catch(PDOException $e){
            $items = array(0);
        }

        return $items;
    }
}

?>