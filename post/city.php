

<?php

$body = file_get_contents('php://input');

if (isset($body)) {
    $city= json_decode($body,true);
} else {
    $city="Error";
}

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../connection.php");

// //do insert
// $sql = $conn->prepare("INSERT INTO `city`(Country_Name, Country_ID) values(?,?)");
// $sql->bind_param("ss", $city['name'], $city['countryID']);


// prepare and bind
$stmt = $conn->prepare("INSERT INTO `city`(City_Name, Country_ID) VALUES (?,?)");

if($stmt == false){
    print_r( $conn->error_list );
    echo $conn->error_get_last();
}

$stmt->bind_param("si", $city['name'], $city['countryID']);

$result = $stmt->execute();

 if($result===TRUE){
 // set response code - 200 OK
     http_response_code(200);
     echo json_encode(
        array(
            "id" => $conn->insert_id,
            "name" => $city['name']
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
