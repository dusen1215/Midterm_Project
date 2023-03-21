<?php
//Headers

header('Access-Control-Allow-Origin: *');//asterik means it's public
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, X-Requested-With');

include_once '../../config/Database.php'; //brings in database and up 2 directories hence ../../
include_once '../../models/Author.php'; //brings in post and up 2 directories hence ../../

 //Instantiate and connect to Database
 $database = new Database();
 $db = $database -> connect();


 //Instantiate author object
 $author = new Author($db);

 //Get raw posted data
 $data=json_decode(file_get_contents("php://input"));

 //Create author
 if($author->create()){
    echo json_encode(
        array('id' => $db-> lastInsertId(),
              'author' => $author->author)
    );
 } else{
    echo json_encode(
        array('message' => 'Array Not Created')
    );
 }