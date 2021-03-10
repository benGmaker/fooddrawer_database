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
//echo "Connected successfully";

$user_id = $_GET['user_id'];
//Show the last item of each food_id
$sql = "SELECT masses.id,masses.mass,masses.date,food.*
        FROM food 
        INNER JOIN masses ON masses.food_id=food.food_id 
        WHERE food.user_id = $user_id AND
              masses.id IN (SELECT MAX(masses.id)
                            FROM masses 
                            GROUP BY masses.food_id)";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
 // output data of each row
 while($row = mysqli_fetch_assoc($result)) {
 //echo "id: " . $row["id"]." Food_id: " . $row["food_id"]." Mass: ".$row["mass"]." date: " . $row["date"]."<br>";
 }
}
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
 //echo ;
 // Encode the array to JSON and output the results
 echo json_encode($resultArray);
}
?>