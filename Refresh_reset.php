<?php
include('connection.php');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Get values from the app
$food_id = $_GET['food_id'];

//change values to food
$sql = "UPDATE `food` SET `Refr` = 0 WHERE food_id=" . $food_id;
mysqli_query($conn, $sql);
?>