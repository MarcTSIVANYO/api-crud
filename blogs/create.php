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
  
// instantiate blog object
include_once '../class/blog.php';
  
$database = new Database();
$db = $database->getConnection();
  
$blog = new Blog($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->type) &&
    !empty($data->title) &&
    !empty($data->detail) &&
    !empty($data->view)
){
  
    // set blog property values
    $blog->type = $data->type;
    $blog->title = $data->title;
    $blog->detail = $data->detail;
    $blog->view = $data->view; 
  
    // create the blog
    if($blog->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "blog was created."));
    }
  
    // if unable to create the blog, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create blog."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create blog. Data is incomplete."));
}
?>