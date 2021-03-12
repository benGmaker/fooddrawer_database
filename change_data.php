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

//change values to food
if ($name != ""){
    $sql = "UPDATE `food` SET `name`='" . $name . "' WHERE food_id=" . $food_id;
} 
if ($unit != "") {
	$sql = "UPDATE `food` SET `unit`='" . $unit . "' WHERE food_id=" . $food_id;
} 
if ($exp != "") {
	$sql = "UPDATE `food` SET `Expiration`='" . $exp . "' WHERE food_id=" . $food_id;
}

if (mysqli_query($conn, $sql)) {
 echo "Record has been changed<br>";
} else {
 echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
}

//Show the content of the table
$sql = "SELECT * FROM food";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
 // output data of each row
 while($row = mysqli_fetch_assoc($result)) {
 echo "food_id: " . $row["food_id"]." name: " . $row["name"]." unit: ".$row["unit"]."<br>";
 }
}
?>