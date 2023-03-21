<?php
//Headers

header('Access-Control-Allow-Origin: *');//asterik means it's public
header('Content-Type: application/json');

include_once '../../config/Database.php'; //brings in database and up 2 directories hence ../../
include_once '../../models/Quote.php'; //brings in post and up 2 directories hence ../../

 //Instantiate and connect to Database
 $database = new Database();
 $db = $database -> connect();


 //Instantiate category object
 $quote = new Quote($db);

 //Get id from url
 $quote->id = isset($_GET['id']) ? $_GET['id'] : die(); //the id gets the value of the id in the url 

 //Get category
 $quote->read_single();

 //Create array 
 $quote_arr = array(
    'id' => $category->id,
    'category' => $quote->category,
    'author' => $quote->author,
    'quote' => $quote -> quote
 );

 //Make JSON 
 if($quote->id !== null) {
   print_r(json_encode($quote_arr));
   } 
   else {
       echo json_encode(
           array('message' => 'Quotes Not Found')
       );
   }
?>