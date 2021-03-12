<?php
include('connection.php');
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
mysqli_query($conn, $sql_create_food_table);
mysqli_query($conn, $sql_create_user_table);
?>