<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/sscInfo.php';

$database = new Database();
$dbcon = $database->getCon();

$sscInfo = new sscInfo($dbcon);

//echo json_encode(array("message" => "created sscInfo object."));

$stmt = $sscInfo->read();

//echo json_encode(array("message" => "sscInfo.read() successful"));
$num = mysqli_num_rows($stmt);

//echo json_encode(array("message" => "num" . $num));

if($num>0){
    $sscInfo_arr=array();
    $sscInfo_arr["records"]=array();

    while($rows = $stmt->fetch_all(MYSQLI_ASSOC)){
        $sscInfo_arr["records"]=$rows;
    }

    http_response_code(200);

    echo json_encode($sscInfo_arr);

    // Free result set
    $stmt->free();

    // Close db connection
    $dbcon->close();
}
else{
    http_response_code(404);

    echo json_encode(array("message" => "No Shoe Size Info found."));

    $stmt->free();

    $dbcon->close();
}
?>