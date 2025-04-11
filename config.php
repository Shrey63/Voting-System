<?php
$servername = "localhost";   // or 127.0.0.1
$username = "root";          // your MySQL username
$password = "root";              // your MySQL password
$database = "voting_system"; // your database name
$port = 3306;                // if using custom port like 3307 change here

$conn = mysqli_connect($servername, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
