<?php
class Drug
{

    // database connection and table name
    private $conn;
    private $table_name = "drug";

    // object properties
    public $id;
    public $drugname;
  

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // read drug
    function read()
    {

        // select all query
        $query = "SELECT * FROM drug";
        // $query = "SELECT * FROM products";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    // create Drug
function create(){
  
    // query to insert record
    $query = "INSERT INTO ".$this->table_name." SET drugname=:drugname";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->drugname=htmlspecialchars(strip_tags($this->drugname));
   
    // bind values
    $stmt->bindParam(":drugname", $this->drugname);
  
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}

// used when filling up the update product form
function readOne(){
  
    // query to read single record
    $query = "SELECT id , drugname FROM ".$this->table_name." WHERE id = ?";
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

    $this->drugname = $row['drugname'];
  
}

// update the drugname
function update(){
  
    // update query
    $query = "UPDATE ".$this->table_name." SET drugname = :drugname WHERE id = :id";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->drugname=htmlspecialchars(strip_tags($this->drugname));
    $this->id=htmlspecialchars(strip_tags($this->id));
  
    // bind new values
    $stmt->bindParam(':drugname', $this->drugname);
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
    $query = "SELECT  id, drugname FROM ".$this->table_name." WHERE id LIKE ?";
  
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
