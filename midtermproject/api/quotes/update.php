<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


$database = new Database();
$db = $database->connect();


$quote = new Quote($db);


$data = json_decode(file_get_contents("php://input"));

$quote->id = $data->id;

//Update Categories' ID
$quote->id = $data->id;
$quote->categoryId = $data->categoryId;
$quote->quote = $data->quote;
$quote->authorId = $data->authorId


if ($quote->update()) {
  echo json_encode(
      array ( 
        'id' => $quote->id,
        'categoryId' => $quote->categoryId,
        'quote' => $quote->quote,
        'authorId' => $quote->authorId,
      )
    );
} else {
  echo json_encode(
      array('message' => 'Category Not Updated')
  );
}
