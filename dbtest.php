<?php
include 'config.php';

if($conn){
    echo "Database Connection Successful!";
} else {
    echo "Failed to connect to Database: " . mysqli_connect_error();
}
?>
