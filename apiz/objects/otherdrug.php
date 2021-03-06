<?php
class Otherdrug
{

    // database connection and table name
    private $conn;
    private $table_name = "otherdrug";

    // object properties
    public $id;
    public $otherdrug;
  

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // read drug
    function read()
    {

        // select all query
        $query = "SELECT * FROM otherdrug";
        // $query = "SELECT * FROM otherdrug";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    // create otherdrug
function create(){
  
    // query to insert record
    $query = "INSERT INTO ".$this->table_name." SET otherdrug=:otherdrug";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->drugname=htmlspecialchars(strip_tags($this->otherdrug));
   
    // bind values
    $stmt->bindParam(":otherdrug", $this->otherdrug);
  
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}

// used when filling up the update product form
function readOne(){
  
    // query to read single record
    $query = "SELECT id , otherdrug FROM ".$this->table_name." WHERE id = ?";
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
  
    // execute query
    $stmt->execute();
  
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // set values to object properties
    $this->id = $row['id'];

    $this->drugname = $row['otherdrug'];
  
}

// update the drugname
function update(){
  
    // update query
    $query = "UPDATE ".$this->table_name." SET otherdrug = :otherdrug WHERE id = :id";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->otherdrug=htmlspecialchars(strip_tags($this->otherdrug));
    $this->id=htmlspecialchars(strip_tags($this->id));
  
    // bind new values
    $stmt->bindParam(':otherdrug', $this->otherdrug);
    $stmt->bindParam(':id', $this->id);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

// delete the drugname
function delete(){
  
    // delete query
    $query = "DELETE FROM ".$this->table_name." WHERE id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}
// search drug
function search($keywords){
  
    // select all query
    $query = "SELECT  id, otherdrug FROM ".$this->table_name." WHERE id LIKE ?";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
  
    // bind
    $stmt->bindParam(1, $keywords);
   
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
}
