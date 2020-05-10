<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// include database and object files
include_once '../config/database.php';
include_once '../class/blog.php';
  
// instantiate database and blog object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$blog = new Blog($db);
// query blogs
$stmt = $blog->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // blogs array
    $blogs = [];
    //$blogs_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $blog_item=array(
            "id" => $id,
            "type" => $type,
            "title" => html_entity_decode($title),
            "detail" => $detail,
            "view" => $view
        );
  
        array_push($blogs , $blog_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show blogs data in json format
    echo json_encode($blogs);
}
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no blogs found
    echo json_encode(
        array("message" => "No blogs found.")
    );
}
  
// no blogs found will be here

?>