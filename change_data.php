<?php
include('connection.php');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Get values from the app
$unit = $_GET['unit'];
$name = $_GET['name'];
$food_id = $_GET['food_id'];
$exp = $_GET['exp'];
$user_id = $_GET['user_id'];

//change values to food
if ($name != ""){
    $sql = "UPDATE `food` SET `user_id`='" . $user_id . "', `IP`=NULL WHERE food_id=" . $food_id;
	mysqli_query($conn, $sql);
} 
if ($name != ""){
    $sql = "UPDATE `food` SET `name`='" . $name . "' WHERE food_id=" . $food_id;
	mysqli_query($conn, $sql);
} 
if ($unit != "") {
	$sql = "UPDATE `food` SET `unit`='" . $unit . "' WHERE food_id=" . $food_id;
	mysqli_query($conn, $sql);
} 
if ($exp != "") {
	$sql = "UPDATE `food` SET `Expiration`='" . $exp . "' WHERE food_id=" . $food_id;
	mysqli_query($conn, $sql);
}
?>