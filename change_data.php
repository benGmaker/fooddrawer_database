<?php
$servername = "localhost";
$username = "user123";
$password = "pw12345";
$db = 'fooddrawer_data';

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//Get values from the python code
//$user_id = $_GET['user_id'];
$unit = $_GET['unit'];
$name = $_GET['name'];
$food_id = $_GET['food_id'];

//change values to food
if ($unit != "" && $name != ""){
    $sql = "UPDATE `food` SET `unit`='" . $unit . "',`name`='" . $name . "' WHERE food_id=" . $food_id;
} elseif ($unit != "") {
	$sql = "UPDATE `food` SET `unit`='" . $unit . "' WHERE food_id=" . $food_id;
} else {
    $sql = "UPDATE `food` SET `name`='" . $name . "' WHERE food_id=" . $food_id;
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