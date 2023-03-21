<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../troubleshooting/failing.php';
include_once '../troubleshooting/parameters.php';


$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

$isAnId = filter_input(INPUT_GET, "id");


 if (isset($isAnId) && $method == 'GET') {
    include('./read_single.php');
} 

// Start of Get all authors redirect logic
 else if ($method == 'GET') {
    include('./read.php');

} 

else if ($method == 'PUT') {
    include('./update.php');
}


else if ($method == 'DELETE') {
    include('./delete.php');
}
// end of get all authors redirect logic

if ($method == 'POST') {
    include('./create.php');
}


?>