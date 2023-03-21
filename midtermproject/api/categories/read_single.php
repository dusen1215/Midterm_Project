<?php
//Headers

header('Access-Control-Allow-Origin: *');//asterik means it's public
header('Content-Type: application/json');

include_once '../../config/Database.php'; //brings in database and up 2 directories hence ../../
include_once '../../models/Category.php'; //brings in post and up 2 directories hence ../../

 //Instantiate and connect to Database
 $database = new Database();
 $db = $database -> connect();


 //Instantiate category object
 $category = new Category($db);

 //Get id from url
 $category->id = isset($_GET['id']) ? $_GET['id'] : die(); //the id gets the value of the id in the url 

 //Get category
 $category->read_single();

 //Create array 
 $category_arr = array(
    'id' => $category->id,
    'category' => $category->author
 );

 //Make JSON 
 if($category->id !== null) {
   print_r(json_encode($category_arr));
   } 
   else {
       echo json_encode(
           array('message' => 'Category Not Found')
       );
   }
?>