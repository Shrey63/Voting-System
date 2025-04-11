<?php
include 'config.php';

echo "<h2>Users Table:</h2>";
$result = mysqli_query($conn, "SELECT * FROM users");
while($row = mysqli_fetch_assoc($result)){
    echo "ID: ".$row['id']." Username: ".$row['username']."<br>";
}

echo "<h2>Candidates Table:</h2>";
$result = mysqli_query($conn, "SELECT * FROM candidates");
while($row = mysqli_fetch_assoc($result)){
    echo "ID: ".$row['id']." Name: ".$row['name']."<br>";
}

echo "<h2>Votes Table:</h2>";
$result = mysqli_query($conn, "SELECT * FROM votes");
while($row = mysqli_fetch_assoc($result)){
    echo "Vote ID: ".$row['id']." User ID: ".$row['user_id']." Candidate ID: ".$row['candidate_id']."<br>";
}
?>
 