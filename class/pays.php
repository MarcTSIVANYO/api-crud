<?php
class Pays{
  
    // database connection and table name
    private $conn;
    private $table_name = "pays";
  
    // object properties
    public $id; 
    public $nom_fr; 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read pays
function read(){
  
    // select all query
    $query = "SELECT * FROM " . $this->table_name;
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}

}
?>