<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/interact.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare interact object
$interact = new Interact($db);
  
// set ID property of record to read
$interact->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// read the details of interact to be edited
$interact->readOne();
  
if($interact->name!=null){
    // create array
    $interact_arr = array(
        "id" =>  $interact->id,
        "iddrug" => $interact->iddrug,
        "idotherdrug" => $interact->idotherdrug,
        "summary" => $interact->summary,
        "severity" => $interact->severity,
        "documentation" => $interact->documentation,
        "clarification" => $clarification,
        "reference" => $reference
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($interact_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user interact does not exist
    echo json_encode(array("message" => "interact does not exist."));
}
?>