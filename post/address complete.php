<?php
if (isset($_GET['country'])) {
    $country= $_GET['country'];
} else {
    $country="South Africa";
}
if (isset($_GET['city'])) {
    $city= $_GET['city'];
} else {
    $city="Cape Town";
}
if (isset($_GET['suburb'])) {
    $suburb= $_GET['suburb'];
} else {
    $suburb="Parklands";
}
if (isset($_GET['suburb_ZIP'])) {
    $suburb_ZIP= $_GET['suburb_ZIP'];
} else {
    $suburb_ZIP=7086;
}
if (isset($_GET['street'])) {
    $street= $_GET['street'];
} else {
    $street="Avenue";
}

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../connection.php");

$sql = "INSERT INTO `country`(`Country_Name`) VALUES ( \"".$country."\")";

if($conn->query($sql)===TRUE){
// set response code - 200 OK
    http_response_code(200);
   $country_id=$conn->insert_id;
} else {
	$sql="SELECT country_ID FROM country WHERE country_Name=\"".$country."\"";   
	$result=$conn->query($sql);
	$country_id=mysqli_fetch_array($result)['country_ID'];
}

$sql = "INSERT INTO `city`(`city_Name`) VALUES ( \"".$city."\")";

if($conn->query($sql)===TRUE){
// set response code - 200 OK
    http_response_code(200);
   $city_id=$conn->insert_id;
} else {
	$sql="SELECT city_ID FROM city WHERE city_Name=\"".$city."\"";   
	$result=$conn->query($sql);
	$city_id=mysqli_fetch_array($result)['city_ID'];
}

$sql = "INSERT INTO `suburb`(`suburb_Name`,'suburb_ZIP') VALUES ( \"".$suburb."\",".$suburb_ZIP.")";

if($conn->query($sql)===TRUE){
// set response code - 200 OK
    http_response_code(200);
   $suburb_id=$conn->insert_id;
} else {
	$sql="SELECT suburb_ID FROM suburb WHERE suburb_Name=\"".$suburb."\"";   
	$result=$conn->query($sql);
	$suburb_id=mysqli_fetch_array($result)['suburb_ID'];
}
$sql = "INSERT INTO `street`(`street_Name`) VALUES ( \"".$street."\")";

if($conn->query($sql)===TRUE){
// set response code - 200 OK
    http_response_code(200);
   $street_id=$conn->insert_id;
} else {
}
 $street_id." ".$suburb_id." ".$city_id." ".$country_id;
 $sql= "INSERT INTO Address(Street_Street_ID,Suburb_Suburb_ID,City_City_ID,Country_Country_ID) VALUES(".$street_id.",".$suburb_id.",".$city_id.",".$country_id.")";
 echo $sql;
 if($conn->query($sql)===TRUE){
// set response code - 200 OK
    http_response_code(200);
   $address_id=$conn->insert_id;
   echo $address_id;
} else {
}
$conn->close();
?>
