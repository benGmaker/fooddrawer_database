<?php
include('connection.php');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = $_GET['user_id'];
//Show the last item of each food_id
$sql = "SELECT food.food_id,masses.mass,food.unit,food.name
        FROM masses 
        RIGHT JOIN food ON food.food_id=masses.food_id 
        WHERE ((food.user_id = $user_id 
                OR 
              food.IP = '" . $_SERVER['REMOTE_ADDR'] . "')
        		    AND
              (masses.id IN (SELECT MAX(masses.id)
                            FROM masses
                            RIGHT JOIN food ON food.food_id = masses.food_id
                            GROUP BY masses.food_id))
                OR 
              food.food_id NOT IN (SELECT masses.food_id FROM masses))
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