<?php 

class MedicineModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function add($data){
        $result;

        try{
            $sql = "CALL sp_addMedicine(:name, :description, :startDate, :duration, :daysInterval, :hoursInterval,:startTime)";
            $connection = $this->db->connect();
            $query = $connection->prepare($sql);

            if($query->execute($data)){
                $result = array(1);
            }else{
                $result = array(0);
            }

        }catch(PDOException $e){
            echo $e;
            $result = array(0);
        }

        return $result;
    
    }
}

?>