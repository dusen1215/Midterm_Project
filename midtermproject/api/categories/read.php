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

 //Category query
 $result = $category->read();
 //Get row count
 $num = $result -> rowCount();//rowCount is a predefined method

 //Check if any categories
 if($num > 0){
    //Category array 
    $category_arr = array();
    $category_arr = array(); //this is where the actual data will go 

    while($row = $result ->fetch(PDO::FETCH_ASSOC)){ //fetches as an associative array
        extract($row);//extract is a predifined method 
        
        $category_item = array(
            'id' => $id,
            'category' => $category
            
        ); 
        //Push to "data"
        array_push ($category_arr, $category_item);
    }

print_r(json_encode($category_arr));
// Turn to JSON & output 
 }
 else{
    echo json_encode(
        array('message' => 'No Categories Found')
    );
 }

 ?>