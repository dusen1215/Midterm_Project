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

 //Category query
 $result = $quote->read();
 //Get row count
 $num = $result -> rowCount();//rowCount is a predefined method

 //Check if any categories
 if($num > 0){
    //Category array 
    $quote_arr = array();
    $quote_arr = array(); //this is where the actual data will go 

    while($row = $result ->fetch(PDO::FETCH_ASSOC)){ //fetches as an associative array
        extract($row);//extract is a predifined method 
        
        $quote_item = array(
            'id' => $id,
            'category' => $category,
            'quote' => html_entity_decode($quote),
            'author' => $author
            
        ); 
        //Push to "data"
        array_push ($quote_arr, $quote_item);
    }

print_r(json_encode($quote_arr));
// Turn to JSON & output 
 }
 else{
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
 }

 ?>