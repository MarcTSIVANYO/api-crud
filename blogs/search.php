<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../class/blog.php';
  
// instantiate database and blog object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$blog = new Blog($db);
  
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";
  
// query blogs
$stmt = $blog->search($keywords);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // blogs array
    $blogs_arr=array();
    $blogs_arr["records"]=array();
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $blog_item=array(
            "id" => $id,
            "title" => $title,
            "detail" => html_entity_decode($detail),
            "type" => $type,
            "view" => $view
        );
  
        array_push($blogs_arr["records"], $blog_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show blogs data
    echo json_encode($blogs_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no blogs found
    echo json_encode(
        array("message" => "No blogs found.")
    );
}
?>