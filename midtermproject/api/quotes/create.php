<?php
//Headers

header('Access-Control-Allow-Origin: *');//asterik means it's public
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, X-Requested-With');

include_once '../../config/Database.php'; //brings in database and up 2 directories hence ../../
include_once '../../models/Category.php'; //brings in post and up 2 directories hence ../../
include_once '../../models/Quote.php';
include_once '../../models/Author.php';


 //Instantiate and connect to Database
 $database = new Category();
 $db = $database -> connect();


 //Instantiate category object
 $quote = new Quote($db);

 //Get raw posted data
 $data=json_decode(file_get_contents("php://input"));

 $quote->id = $data->id;
 $quote->category = $data->category;
 $quote->authorId = $data->authorId;
 $quote->categoryId = $data->categoryId;

 //Create category
 if($quote->create()){
    echo json_encode(
        array('id' => $db-> lastInsertId(),
              'quote' => $quote -> quote,
              'authorId' => $quote->authorId,
              'categoryId' => $quote->categoryId
            )
    );
 } else{
    echo json_encode(
        array('message' => 'Quote Not Created')
    );
 }

 ?>