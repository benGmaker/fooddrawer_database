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
//Show the content of the table
$sql = "SELECT food_id FROM food
WHERE user_id = " . $user_id .
" ORDER BY food_id ASC";

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
 $resultArrayfood = array();
 $tempArrayfood = array();
 
 // Loop through each result
 while($row = mysqli_fetch_assoc($result))
 {
 // Add each result into the results array
 $tempArrayfood = $row;
     array_push($resultArrayfood, $tempArrayfood);
 }
}

$Final_data = Array();
foreach($resultArrayfood as $result) {
    $food_id = $result['food_id'];
    $numdays = $_GET['days'];
    define('SECONDS_PER_DAY', 86400);
    $date = date('Y-m-d H:m:s', time() - $numdays * SECONDS_PER_DAY);
    //Show the content of the table
    $sql = "SELECT masses.mass,masses.date FROM masses
    INNER JOIN food ON food.food_id=masses.food_id
    WHERE food.food_id = $food_id AND masses.date > '$date'
    ORDER BY masses.date ASC";

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
    }
array_push($Final_data, Array('food_id' => $food_id, 'data' => $resultArray));
}
echo json_encode($Final_data);
?>