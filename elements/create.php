<?php
// required headers
/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
*/

header("Access-Control-Allow-Origin: http://localhost:4200/");
header("Access-Control-Allow-Methods: PUT,GET,POST,DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
// get database connection
include_once '../config/database.php';
  
// instantiate elements object
include_once '../class/elements.php';
  
$database = new Database();
$db = $database->getConnection();
  
$elements = new Element($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->titre) &&
    !empty($data->description) &&
    !empty($data->url) &&
    !empty($data->nom)&&
    !empty($data->prenoms)&&
    !empty($data->emails)&&
    !empty($data->pays_id)&&
    !empty($data->domaine_id)
){
  
    // set elements property values
    $elements->titre = $data->titre;
    $elements->description = $data->description;
    $elements->url = $data->url;
    $elements->nom = $data->nom;
    $elements->prenoms = $data->prenoms;
    $elements->emails = $data->emails;
    $elements->pays_id = $data->pays_id; 
    $elements->domaine_id = $data->domaine_id; 
   
    // create the elements
    if($elements->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "elements was created."));
    }
  
    // if unable to create the elements, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create elements."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create elements. Data is incomplete."));
}
?>