

<?php
// // localhost/real_estate/post/person.php?Address_ID=22&Person_Firstname=Jonas&Person_LastName=Schiller&Person_PhoneNumber=2212&Person_Email=jonasschiller@online.de&Person_DOB=1998-06-24
// if (isset($_GET['Address_ID'])) {
//     $Address_ID= $_GET['Address_ID'];
// } else {
//     $Address_ID="Error";
// }
// if (isset($_GET['Person_Firstname'])) {
//     $Person_Firstname= $_GET['Person_Firstname'];
// } else {
//     $Person_Firstname="Error";
// }
// if (isset($_GET['Person_LastName'])) {
//     $Person_LastName= $_GET['Person_LastName'];
// } else {
//     $Person_LastName="Error";
// }
// if (isset($_GET['Person_PhoneNumber'])) {
//     $Person_PhoneNumber= $_GET['Person_PhoneNumber'];
// } else {
//     $Person_PhoneNumber="";
// }
// if (isset($_GET['Person_Email'])) {
//     $Person_Email= $_GET['Person_Email'];
// } else {
//     $Person_Email="";
// }
// if (isset($_GET['Person_DOB'])) {
//     $Person_DOB= $_GET['Person_DOB'];
// } else {
//     $Person_DOB="";
// }

$body = file_get_contents('php://input');

if (isset($body)) {
    $person= json_decode($body,true);
} else {
    $person="Error";
}

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../connection.php");

$sql = $conn->prepare("INSERT INTO `person`(`Address_Address_ID`, `Person_Firstname`, `Person_LastName`, `Person_PhoneNumber`, `Person_Email`, `Person_DOB`) VALUES (?,?,?,?,?,?)");

if($sql != false){
    $sql->bind_param("isssss", $person['address'], $person['firstname'],$person['firstname'],$person['phone'],$person['email'],$person['dob']);
    $result = $sql->execute();

    if($result===TRUE){
        // set response code - 200 OK
        http_response_code(200);

        $person_id=$conn->insert_id;

        echo json_encode(array(
            "id" => $person_id,
            "addressID" => $person['address'],
            "firstname" => $person['firstname'],
            "lastname" => $person['lastname'],
            "phone" => $person['phone'],
            "email" => $person['email'],
            "dob" => $person['dob']
        ));

        $conn->close();
        die();
    }
}

// set response code - 404 Not found
    http_response_code(404);
    print_r( $conn->error_list );

$conn->close();
?>
