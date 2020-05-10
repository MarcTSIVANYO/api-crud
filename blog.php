<?php

include 'database.php';
$posts = [];
$sql = "SELECT * FROM blogs order by id desc ";
if($result = $db->query($sql))
{
$i = 0;
while($row = $result->fetch_assoc())
{
$posts[$i]['id'] = $row['id'];
$posts[$i]['type'] = $row['type'];  
$posts[$i]['title'] = $row['title'];
$posts[$i]['detail'] = $row['detail'];
$posts[$i]['view'] = $row['view'];
$i++;
}
echo json_encode($posts);
}
else
{
http_response_code(404);
}
?>