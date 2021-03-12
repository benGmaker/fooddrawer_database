<?php
include('connection.php');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//Get values from the python code
$food_id = $_GET['food_id'];
$mass = $_GET['mass'];

//Add values to table
$sql = "INSERT INTO masses (food_id, mass, date)
VALUES ($food_id, $mass, '". date("Y-m-d H") ."')";

mysqli_query($conn, $sql)
?>