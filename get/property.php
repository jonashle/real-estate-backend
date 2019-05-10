

<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../connection.php");

$sql = "SELECT * FROM property";
$result = $conn->query($sql);
$jsonarray=array();

if ($result->num_rows > 0) {
    // output data of each row
	while($arrayresult = mysqli_fetch_array($result)) {
       $myArray[] = array(
                        "Prop_ID"=>$arrayresult['Prop_ID'],
						"Prop_Description"=>$arrayresult['Prop_Description'],
						"Prop_Bedrooms"=>$arrayresult['Prop_Bedrooms'],
						"Prop_Bathrooms"=>$arrayresult['Prop_Bathrooms'],
						"Prop_SquareMeter"=>$arrayresult['Prop_SquareMeter'],
						"Address_Address_ID"=>$arrayresult['Address_Address_ID'],
						"Prop_Pool"=>$arrayresult['Prop_Pool'],
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
