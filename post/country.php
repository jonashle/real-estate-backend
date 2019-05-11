

<?php

$body = file_get_contents('php://input');

if (isset($body)) {
    $country= json_decode($body,true);
} else {
    $country="Error";
}

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../connection.php");

//do insert
$sql = "INSERT INTO `country`(Country_Name) values('" . $country['name']  . "')";
$result = $conn->query($sql);

 if($result===TRUE){
 // set response code - 200 OK
     http_response_code(200);
     echo json_encode(
        array(
            "id" => $conn->insert_id,
            "name" => $country['name']
        )
     );
 } else {
 // set response code - 404 Not found
     http_response_code(404);
    echo json_encode(
        array("message" => $conn->error)
    );
 }


$conn->close();
?>
