<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../class/blog.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$blog = new Blog($db);
  
// set ID property of record to read
$blog->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of product to be edited
$blog->readOne();
  
if($blog->title!=null){
    // create array
    $blog_arr = array(
        "id" =>  $blog->id,
        "title" => $blog->title,
        "detail" => $blog->detail,
        "type" => $blog->type,
        "view" => $blog->view  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($blog_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>