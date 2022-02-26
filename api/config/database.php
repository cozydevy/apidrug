<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

header("Content-Type: application/json; charset=UTF-8");

class Database{
  
    // specify your own database credentials
    // private $host = "sql206.epizy.com";
    // private $db_name = "epiz_31154023_dbdrug";
    // private $username = "epiz_31154023";
    // private $password = "Z1TeI0la9woEd4";

    private $host = "localhost";
    private $db_name = "dbdrug";
    private $username = "root";
    private $password = "";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>