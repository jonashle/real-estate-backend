<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../connection.php");

$sql = "SELECT * FROM available";
$result = $conn->query($sql);
$jsonarray=array();

if ($result->num_rows > 0) {
    // output data of each row
	while($arrayresult = mysqli_fetch_array($result)) {
       $myArray[] = array(
                        "Avail_ID"=>$arrayresult['Avail_ID'],
			"Avail_ListingDate"=>$arrayresult['Avail_ListingDate'],
			"Avail_ListingPrice"=>$arrayresult['Avail_ListingPrice'],
			"Seller_Seller_ID"=>$arrayresult['Seller_Seller_ID'],
			"Agent_Agent_ID"=>$arrayresult['Agent_Agent_ID'],
			"Property_ID"=>$arrayresult['Property_ID'],
						
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
        array("message" => "No properties found.")
    );
}
$conn->close();
?>
