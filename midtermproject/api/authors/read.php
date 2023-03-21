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

 //Blog post query
 $result = $author->read();
 //Get row count
 $num = $result -> rowCount();//rowCount is a predefined method

 //Check if any posts
 if($num > 0){
    //Author array 
    $author_arr = array();
    $author_arr = array(); //this is where the actual data will go 

    while($row = $result ->fetch(PDO::FETCH_ASSOC)){ //fetches as an associative array
        extract($row);//extract is a predifined method 
        
        $author_item = array(
            'id' => $id,
            'author' => $author
            
        ); 
        //Push to "data"
        array_push ($author_arr, $author_item);
    }

print_r(json_encode($author_arr));
// Turn to JSON & output 
 }
 else{
    echo json_encode(
        array('message' => 'No Authors Found')
    );
 }