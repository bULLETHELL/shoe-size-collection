<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested_With');

include_once '../config/database.php';
include_once '../objects/sscInfo.php';

echo json_encode(array("message" => "Create running."));

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
    $sscInfo->name = $data->name;
    $sscInfo->email = $data->email;
    $sscInfo->age = $data->age;
    $sscInfo->shoe_size = $data->shoe_size;

    if($sscInfo->create()){
        http_response_code(201);

        echo json_encode(array("message" => "Shoe Size Collection Info was created."));
    }
    else{
        http_response_code(503);

        echo json_encode(array("message" => "Unable to create Shoe Size Collection Info."));
    }
}
else{
    http_response_code(400);

    echo json_encode(array("message" => "Unable to create Shoe Size Collection Info. Data is incomplete."))
}




$query = "SELECT idAssignment, nameAssignment, pathAssignment FROM Assignment";
$result = $mysqli->query($query);

/* numeric array */
//$rows = $result->fetch_all(MYSQLI_NUM);
/*foreach($rows as $row){
    printf ("id: %s, name: %s, path: %s\n", $row[0], $row[1], $row[2]);
}*/

/* associative array */

$rows = $result->fetch_all(MYSQLI_ASSOC);
/*
printf ("%s (%s)\n", $row["idAssignment"], $row["nameAssignment"], $row["pathAssignment"]);
*/

echo json_encode($rows);

/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>