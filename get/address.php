<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../connection.php");

$sql = "SELECT * FROM address";
$result = $conn->query($sql);
$jsonarray=array();

if ($result->num_rows > 0) {
    // output data of each row
	while($arrayresult = mysqli_fetch_array($result)) {
       $myArray[] = array(
                        "Address_ID"=>$arrayresult['Address_ID'],
						"StreetID"=>$arrayresult['Street_Street_ID'],
						"SuburbID"=>$arrayresult['Suburb_Suburb_ID'],
						"CityID"=>$arrayresult['City_City_ID'],
						"CountryID"=>$arrayresult['Country_Country_ID'],
                                           );
    }
	// set response code - 200 OK
    http_response_code(200);

    echo json_encode($myArray);
} else {
// set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No addresses found.")
    );
}
$conn->close();
?>
