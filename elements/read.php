<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// include database and object files
include_once '../config/database.php';
include_once '../class/elements.php';
  
// instantiate database and elements object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$elements = new Element($db);
// query elements
$stmt = $elements->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // elements array
    $elements = [];
    //$elements_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $elements_item=array(
            "id" => $id, 
            "titre" => html_entity_decode($titre), 
            "description" => html_entity_decode($description), 
            "img" => html_entity_decode($img), 
            "url" => html_entity_decode($url), 
            "nom" => html_entity_decode($nom), 
            "prenoms" => html_entity_decode($prenoms), 
            "emails" => html_entity_decode($emails), 
            "pays_id" => $pays_id,
            "domaine_id" => $domaine_id
        );
  
        array_push($elements , $elements_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show elements data in json format
    echo json_encode($elements);
}
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no elements found
    echo json_encode(
        array("message" => "No elements found.")
    );
}
   
?>