<?php
//Headers

header('Access-Control-Allow-Origin: *');//asterik means it's public
header('Content-Type: application/json');

include_once '../../config/Database.php'; //brings in database and up 2 directories hence ../../
include_once '../../models/Author.php'; //brings in post and up 2 directories hence ../../

 //Instantiate and connect to Database
 $database = new Database();
 $db = $database -> connect();


 //Instantiate author object
 $author = new Author($db);

 //Get id from url
 $author->id = isset($_GET['id']) ? $_GET['id'] : die(); //the id gets the value of the id in the url 

 //Get author
 $author->read_single();

 //Create array 
 $author_arr = array(
    'id' => $author->id,
    'author' => $author->author
 );

 //Make JSON 
 if($author->id !== null) {
   print_r(json_encode($author_arr));
   } 
   else {
       echo json_encode(
           array('message' => 'Author Not Found')
       );
   }