<?php
header('Content-Type: application/json');

$mysqli = new mysqli("localhost", "pmon01.skp-dp", "yppyqyy2", "pmon01_skp_dp_sde_dk");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT id, name, email, age, shoe_size FROM sscInfo";
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