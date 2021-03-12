<?php
include('connection.php');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

//Get values from the python code
$MAC = $_GET['mac'];

//Add values to table
$sql_add =  "INSERT INTO food (IP,MAC)
            VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', '$MAC')";

$sql_id =   "SELECT food_id FROM food
            WHERE mac = '$MAC'";

$result = mysqli_query($conn, $sql_id);
$row_cnt = $result->num_rows;
//echo $row_cnt;
if($row_cnt == 0){
    mysqli_query($conn, $sql_add);
}

$result = mysqli_query($conn, $sql_id);
if ($result = mysqli_query($conn, $sql_id))
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