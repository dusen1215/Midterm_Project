<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

$isAnId = filter_input(INPUT_GET, "id");


 if (isset($isAnId) && $method == 'GET') {
    include('./read_single.php');
} 

// Start of Get all categories redirect logic
 else if ($method == 'GET') {
    include('./read.php');

} 

else if ($method == 'POST') {
    include('./create.php');
}

else if ($method == 'PUT') {
    include('./update.php');
}

else if ($method == 'DELETE') {
    include('./delete.php');
}

else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}



?>