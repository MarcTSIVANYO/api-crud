<?php
class Element{
  
    // database connection and table name
    private $conn;
    private $table_name = "elements";
   
    // object properties 
    public $titre; 
    public $description; 
    public $img; 
    public $url;  
    public $nom; 
    public $view; 
    public $prenoms; 
    public $emails;
    public $pays_id; 
    public $domaine_id;  
  
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

// create product
function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                titre=:titre, description=:description,  url=:url, nom=:nom, prenoms=:prenoms, emails=:emails, pays_id=:pays_id, domaine_id=:domaine_id";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->titre=htmlspecialchars(strip_tags($this->titre));
    $this->description=htmlspecialchars(strip_tags($this->description));
   // $this->img=htmlspecialchars(strip_tags($this->img));
    $this->url=htmlspecialchars(strip_tags($this->url)); 
    $this->nom=htmlspecialchars(strip_tags($this->nom)); 
    $this->prenoms=htmlspecialchars(strip_tags($this->prenoms)); 
    $this->emails=htmlspecialchars(strip_tags($this->emails)); 
    $this->pays_id=htmlspecialchars(strip_tags($this->pays_id)); 
    $this->domaine_id=htmlspecialchars(strip_tags($this->domaine_id)); 
  
    // bind values
    $stmt->bindParam(":titre", $this->titre);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":url", $this->url);
    $stmt->bindParam(":nom", $this->nom); 
    $stmt->bindParam(":prenoms", $this->prenoms); 
    $stmt->bindParam(":emails", $this->emails); 
    $stmt->bindParam(":pays_id", $this->pays_id); 
    $stmt->bindParam(":domaine_id", $this->domaine_id); 
  
    // execute query
    if($stmt->execute()){
        return true;
    } 
    return false;  
}

}
?>