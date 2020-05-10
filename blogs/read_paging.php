<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../class/blog.php';
  
// utilities
$utilities = new Utilities();
  
// instantiate database and blog object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$blog = new Blog($db);
  
// query blogs
$stmt = $blog->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // blogs array
    $blogs_arr=array();
    $blogs_arr["records"]=array();
    $blogs_arr["paging"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $blog_item=array( 
            "id" =>  $id,
            "title" => $title,
            "detail" => $detail,
            "type" => $type,
            "view" => $view  
        );
  
        array_push($blogs_arr["records"], $blog_item);
    }
  
  
    // include paging
    $total_rows=$blog->count();
    $page_url="{$home_url}blog/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $blogs_arr["paging"]=$paging;
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($blogs_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user blogs does not exist
    echo json_encode(
        array("message" => "No blogs found.")
    );
}
?>