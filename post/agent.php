<?php
if (isset($_GET['person_ID'])) {
    $person_ID= $_GET['person_ID'];
} else {
    $person_ID="Error";
}

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../connection.php");

$sql = "INSERT INTO `agent`(Person_Person_ID) 
VALUES (".$person_ID.")";
echo $sql;
if($conn->query($sql)===TRUE){
// set response code - 200 OK
    http_response_code(200);
   $agent_id=$conn->insert_id;
} else {
// set response code - 404 Not found
    http_response_code(404);
}
$conn->close();
?>
