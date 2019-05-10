<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../connection.php");

$sql = "SELECT * FROM sales";
$result = $conn->query($sql);
$jsonarray=array();

if ($result->num_rows > 0) {
    // output data of each row
	while($arrayresult = mysqli_fetch_array($result)) {
       $myArray[] = array(
                        "Sale_ID"=>$arrayresult['Sale_ID'],
			"Agent_Agent_ID"=>$arrayresult['Agent_Agent_ID'],
			"Buyer_Buyer_ID"=>$arrayresult['Buyer_Buyer_ID'],
			"Property_Prop_ID"=>$arrayresult['Property_Prop_ID'],
			"Sale_Amount"=>$arrayresult['Sale_Amount'],
			"Sale_Percentage"=>$arrayresult['Sale_Percentage'],
			"Sale_Date"=>$arrayresult['Sale_Date'],
			"Sales_TimeOnMarket"=>$arrayresult['Sales_TimeOnMarket'],
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
