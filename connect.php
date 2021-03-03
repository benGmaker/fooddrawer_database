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

// Create table
$sql_create_masses_table = 
" CREATE TABLE IF NOT EXISTS masses (
    id integer PRIMARY KEY AUTO_INCREMENT,
    food_id integer NOT NULL,
    mass integer NOT NULL,
    date DATETIME NOT NULL
);";
$sql_create_user_table = 
" CREATE TABLE IF NOT EXISTS user (
    user_id integer PRIMARY KEY AUTO_INCREMENT,
    Name text NOT NULL,
    email_adress text NOT NULL,
    password text NOT NULL
); ";
$sql_create_food_table = 
" CREATE TABLE IF NOT EXISTS food (
    food_id integer PRIMARY KEY AUTO_INCREMENT,
    user_id integer NOT NULL,
    unit text NOT NULL,
    name text NOT NULL
);";
mysqli_query($conn, $sql_create_masses_table);
if ($conn->query($sql_create_masses_table) === TRUE) {
    echo "Database created successfully";
} 
else {
    echo "Error creating database: " . $conn->error;
}
mysqli_query($conn, $sql_create_food_table);
if ($conn->query($sql_create_food_table) === TRUE) {
    echo "Database created successfully";
} 
else {
    echo "Error creating database: " . $conn->error;
}
mysqli_query($conn, $sql_create_user_table);
if ($conn->query($sql_create_user_table) === TRUE) {
    echo "Database created successfully";
} 
else {
    echo "Error creating database: " . $conn->error;
}

//Get values from the python code
//$user_id = $_GET['user_id'];
$unit = $_GET['unit'];
$food_id = $_GET['food_id'];
$mass = $_GET['mass'];

//Add values to table
$sql = "INSERT INTO masses (food_id, mass, unit, date)
VALUES (" . $food_id . ", ". $mass .", '". $unit ."', '". date("Y-m-d H:i:s") ."')";

if (mysqli_query($conn, $sql)) {
 echo "New record created successfully<br>";
} else {
 echo "Error: " . $sql . "<br>" . mysqli_error($conn) . "<br>";
}

//Show the content of the table
$sql = "SELECT * FROM masses";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
 // output data of each row
 while($row = mysqli_fetch_assoc($result)) {
 echo "id: " . $row["id"]." Food_id: " . $row["food_id"]." Mass: ".$row["mass"]." date: " . $row["date"]."<br>";
 }
} else {
 echo "0 results";
}
//echo date("Y-m-d", mktime(date("m") , date("d") - 5, date("Y")));
define('SECONDS_PER_DAY', 86400);
echo date('Y-m-d H:i:s', time() - 5 * SECONDS_PER_DAY);
//echo strtotime(date("Y-m-d", strtotime("-5 day")))
?>