<?php
include('connection.php');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

//Get values from the python code
$food_id = $_GET['food_id'];

//Add values to table
$sql =   "SELECT Refr FROM food
            WHERE food_id = '$food_id'";

$result = mysqli_query($conn, $sql);
if ($result = mysqli_query($conn, $sql))
{
 // We have results, create an array to hold the results
        // and an array to hold the data
 $resultArray = array();
 $tempArray = array();
 
 // Loop through each result
 while($row = mysqli_fetch_assoc($result))
 {
 // Add each result into the results array
 $tempArray = $row;
     array_push($resultArray, $tempArray);
 }
 // Encode the array to JSON and output the results
 echo json_encode($resultArray);
}

?>