<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested_With');

include_once '../config/database.php';
include_once '../objects/sscInfo.php';

//echo json_encode(array("message" => "Create running."));

$database = new Database();
$dbcon = $database->getCon();
$sscInfo = new sscInfo($dbcon);
$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->name) &&
    !empty($data->email) &&
    !empty($data->age) &&
    !empty($data->shoe_size)
){
    //echo json_encode(array("message" => "if statement running."));
    $sscInfo->name = $data->name;
    $sscInfo->email = $data->email;
    $sscInfo->age = $data->age;
    $sscInfo->shoe_size = $data->shoe_size;
    //echo json_encode(array("message" => "object variables set."));

    if($sscInfo->create()){
        //echo json_encode(array("message" => "sscInfo.create running."));
        
        http_response_code(201);

        echo json_encode(array("message" => "Shoe Size Collection Info was created."));

        $dbcon->close();
    }
    else{
        http_response_code(503);

        echo json_encode(array("message" => "Unable to create Shoe Size Collection Info."));

        $dbcon->close();
    }
}
else{
    http_response_code(400);

    echo json_encode(array("message" => "Unable to create Shoe Size Collection Info. Data is incomplete."));

    $dbcon->close();
}
?>