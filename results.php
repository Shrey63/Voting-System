
<!-- Step 6: results.php -->
<?php include 'config.php'; ?>
<h2>Voting Results</h2>

<?php
$results = $conn->query("SELECT candidates.name, COUNT(votes.id) as vote_count FROM candidates LEFT JOIN votes ON candidates.id=votes.candidate_id GROUP BY candidates.id");

while ($row = $results->fetch_assoc()) {
    // Vulnerable to XSS
    echo "Candidate: " . $row['name'] . " - Votes: " . $row['vote_count'] . "<br>";
}
?>

<a href='logout.php'>Logout</a>