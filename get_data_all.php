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

$user_id = $_GET['user_id'];
//Show the last item of each food_id
$sql = "SELECT masses.food_id,masses.mass,food.unit,food.name
        FROM food 
        INNER JOIN masses ON masses.food_id=food.food_id 
        WHERE food.user_id = $user_id AND
              masses.id IN (SELECT MAX(masses.id)
                            FROM masses
                            GROUP BY masses.food_id)
        ORDER BY food.name";

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