<?php 
    class Database {
        private $host = "localhost";
        private $database_name = "mangapi";
        private $username = "root";
        private $password = "";

        public $connect;

        public function getConnexion(){
            $this->connect = null;
            try{
                $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->connect->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->connect;
        }
    }  
?>