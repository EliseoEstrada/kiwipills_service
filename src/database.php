<?php

class Database{
    private static $host;
    private static $db;
    private static $user;
    private static $password;
    private static $charset;
    
    private static $instance;

    protected function __construct(){
        
    }

    public static function getInstance() {
        $cls = static::class;
        if (!isset(self::$instance)){
            self::$instance = new static();
            self::$host = HOST;
            self::$db = DB;
            self::$user = USER;
            self::$password = PASSWORD;
            self::$charset = CHARSET;
        }

        return self::$instance;
    }

    function connect(){
    
        try{
            $connection = "mysql:host=".self::$host.";dbname=" . self::$db . ";charset=" . self::$charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, self::$user, self::$password, $options);
            //$pdo = new PDO($connection,$this->user,$this->password);
        
            return $pdo;


        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
}

?>