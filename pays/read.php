<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// include database and object files
include_once '../config/database.php';
include_once '../class/pays.php';
  
// instantiate database and pays object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$pays = new Pays($db);
// query payss
$stmt = $pays->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // payss array
    $payss = [];
    //$payss_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $pays_item=array(
            "id" => $id, 
            "nom_fr" => html_entity_decode($nom_fr) 
        );
  
        array_push($payss , $pays_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show payss data in json format
    echo json_encode($payss);
}
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no payss found
    echo json_encode(
        array("message" => "No payss found.")
    );
}
   
?>