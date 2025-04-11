
<!-- Step 5: vote.php -->
<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

$uid = $_SESSION['user_id'];
$results = $conn->query("SELECT * FROM candidates");

echo "<h3>Vote for a Candidate</h3>";
while ($row = $results->fetch_assoc()) {
    echo $row['id'] . ". " . $row['name'] . " <a href='vote.php?vote_id=" . $row['id'] . "'>Vote</a><br>";
}

if (isset($_GET['vote_id'])) {
    $cid = $_GET['vote_id']; // Vulnerable
    $conn->query("INSERT INTO votes (user_id, candidate_id) VALUES ('$uid', '$cid')");
    echo "Voted Successfully! <a href='results.php'>View Results</a>";
}
?>