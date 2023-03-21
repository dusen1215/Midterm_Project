<?php
//Headers

header('Access-Control-Allow-Origin: *');//asterik means it's public
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, X-Requested-With');

include_once '../../config/Database.php'; //brings in database and up 2 directories hence ../../
include_once '../../models/Category.php'; //brings in post and up 2 directories hence ../../

 //Instantiate and connect to Database
 $database = new Category();
 $db = $database -> connect();


 //Instantiate category object
 $category = new Category($db);

 //Get raw posted data
 $data=json_decode(file_get_contents("php://input"));

 $category->id = $data->id;
 $category->category = $data->category;

 //Create category
 if($category->create()){
    echo json_encode(
        array('id' => $db-> lastInsertId(),
              'category' => $category -> category)
    );
 } else{
    echo json_encode(
        array('message' => 'Category not created')
    );
 }

 ?>