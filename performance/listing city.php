<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include("../connection.php");

$sql = "SELECT city.City_Name, COUNT(*) AS Amount
FROM ((((available
INNER JOIN property
On available.Property_ID =property.Prop_ID)
INNER JOIN address
ON address.Address_ID=property.Address_Address_ID)
INNER JOIN street
ON street.Street_ID=address.Address_ID)
INNER JOIN suburb
ON suburb.Suburb_ID=street.Suburb_Suburb_ID)
INNER JOIN city
ON city.City_ID=suburb.City_ID
GROUP BY city.City_ID";

echo $sql;
$result = $conn->query($sql);
$jsonarray=array();
if ($result->num_rows > 0) {
    // output data of each row
	while($arrayresult = mysqli_fetch_array($result)) {
       $myArray[] = array( 
						"City_Name"=>$arrayresult['City_Name'],
						"Amount"=>$arrayresult['Amount'],		
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
