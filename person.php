<?php
$body = file_get_contents('php://input');
if (isset($body)) {
    $person= json_decode($body,true);
} else {
    $person="Error";
}
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PUT, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");
include("../connection.php");
// prepare statement
$stmt = $conn->prepare("update `person`
set
`Address_Address_ID`= ?,
`Person_Firstname`= ?,
`Person_LastName`= ?,
`Person_PhoneNumber`= ?,
`Person_Email`= ?,
`Person_DOB`= ?
where `Person_ID` = ?");
if($stmt == false){
    print_r( $conn->error_list );
    echo $conn->error_get_last();
    die();
}
//bind params
$stmt->bind_param("isssssi", $person['addressID'], $person['firstname'], $person['lastname'], $person['phone'],
    $person['email'], $person['dob'], $person['id']);
$result = $stmt->execute();
 if($result===TRUE){
 // set response code - 200 OK
     http_response_code(200);
     echo json_encode(
        array(
            "id" => $person['id'],
            "addressID" => $person['addressID'],
            "firstname" => $person['firstname'],
            "lastname" => $person['lastname'],
            "phone" => $person['phone'],
            "email" => $person['email'],
            "dob" => $person['dob']
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