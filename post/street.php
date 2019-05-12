<?php

$body = file_get_contents('php://input');

if (isset($body)) {
    $street= json_decode($body,true);
} else {
    $street="Error";
}

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../connection.php");

// prepare statement
$stmt = $conn->prepare("INSERT INTO `street`(`Street_Name`, `Suburb_ID`) VALUES (?,?)");

if($stmt == false){
    print_r( $conn->error_list );
    echo $conn->error_get_last();
}

//bind params
$stmt->bind_param("si", $street['name'], $street['suburbID']);

$result = $stmt->execute();

 if($result===TRUE){
 // set response code - 200 OK
     http_response_code(200);
     echo json_encode(
        array(
            "id" => $conn->insert_id,
            "name" => $street['name'],
            "suburbID" => $street['suburbID']
        )
     );

     die();
 }
// set response code - 404 Not found
    http_response_code(404);
   echo json_encode(
       array("message" => $conn->error_get_last())
   );

$conn->close();
?>
