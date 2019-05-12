<?php
$year;
if (isset($_GET['year'])) {
    $year= $_GET['year'];
} else {
    $year=2018;
}
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include("../connection.php");

$sql = "SELECT  MAX(Amount), Person_Firstname, Person_LastName
FROM (SELECT SUM(sales.Sale_Amount)AS Amount, person.Person_Firstname,person.Person_LastName
FROM (agent
INNER JOIN sales
ON agent.Agent_ID=sales.Agent_Agent_ID)
INNER JOIN person 
ON person.Person_ID=agent.Agent_ID
WHERE YEAR(sales.Sale_Date)=".$year."
GROUP BY agent.Agent_ID) de";

echo $sql;
$result = $conn->query($sql);
$jsonarray=array();
if ($result->num_rows > 0) {
    // output data of each row
	while($arrayresult = mysqli_fetch_array($result)) {
       $myArray[] = array( 
						"Agent_FirstName"=>$arrayresult['Person_Firstname'],
						"Agent_LastName"=>$arrayresult['Person_LastName'],		
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
