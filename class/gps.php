<?php
    class GPS{
        // Connection
        private $conn;
        // Table
        private $db_table = "ftGPS";
        // Columns
        public $idGPS;
        public $latitude;
        public $longitude;
        public $date;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getGPS(){
            $sqlQuery = "SELECT idGPS, latitude, longitude, date FROM " . $this->db_table . " ORDER BY idGPS DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createGPS(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET latitude = :latitude, longitude = :longitude";
        
            $stmt = $this->conn->prepare($sqlQuery);
                    
            // sanitize
            $this->latitude=htmlspecialchars(strip_tags($this->latitude));
            $this->longitude=htmlspecialchars(strip_tags($this->longitude));

            // bind data
            $stmt->bindParam(":latitude", $this->latitude);
            $stmt->bindParam(":longitude", $this->longitude);

            if($stmt->execute()){
               return true;
            }
            return false;
        }
        
    }
?>