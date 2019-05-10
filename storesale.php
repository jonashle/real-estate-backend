<?php
$buyer_ID;
$sales_Percentage;
if (isset($_GET['buyer_ID'])) {
    $buyer_ID= $_GET['buyer_ID'];
} else {
    $buyer_ID=1;
}
if (isset($_GET['sales_Percentage'])) {
    $sales_Percentage= $_GET['sales_Percentage'];
} else {
    $sales_Percentage=10;
}
if (isset($_GET['avail_ID'])) {
    $avail_ID= $_GET['avail_ID'];
} else {
    $avail_ID=1;
}
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include("connection.php");

$sql = "INSERT INTO sales (Agent_Agent_ID,Buyer_Buyer_ID,sales.Property_Prop_ID,Sale_Amount,Sale_Percentage,Sale_Date,Sales_TimeOnMarket)
SELECT Agent_Agent_ID,".$buyer_ID.", Property_ID,Avail_ListingPrice,".$sales_Percentage.",\"".date('Y-m-d',time()).
"\",DATEDIFF(Avail_ListingDate,\"".date('Y-m-d',time())."\") FROM available
WHERE available.Avail_ID=".$avail_ID;

if($conn->query($sql)===TRUE){
$last_id=$conn->insert_id;

	// set response code - 200 OK
    http_response_code(200);
$sql="DELETE FROM available WHERE avail_ID=".$avail_ID;
if($conn->query($sql)===TRUE){
echo "\n Deleted";
}
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
