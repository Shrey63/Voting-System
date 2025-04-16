<?php include 'config.php'; ?>

<?php
// Fetch candidates sorted by vote count DESC
$results = $conn->query("
    SELECT candidates.name, COUNT(votes.id) as vote_count 
    FROM candidates 
    LEFT JOIN votes ON candidates.id = votes.candidate_id 
    GROUP BY candidates.id 
    ORDER BY vote_count DESC
");

$candidates = [];
while ($row = $results->fetch_assoc()) {
    $candidates[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voting Results</title>
    <style>
        body {
            background: #f2f6ff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #0033cc;
            margin-bottom: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 80, 0.1);
            text-align: center;
            border-left: 5px solid transparent;
        }

        .card.winner {
            border-left: 5px solid #2ecc71;
            background-color: #eaffea;
        }

        .card h3 {
            margin: 0;
            font-size: 20px;
            color: #002b80;
        }

        .card p {
            font-size: 16px;
            margin-top: 10px;
            color: #333;
        }

        .logout-btn {
            display: block;
            text-align: center;
            margin-top: 40px;
        }

        .logout-btn a {
            text-decoration: none;
            background-color: #0066ff;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
        }

        .logout-btn a:hover {
            background-color: #0047b3;
        }
    </style>
</head>
<body>

<h2>Voting Results</h2>

<div class="container">
    <?php foreach ($candidates as $index => $row): ?>
        <div class="card <?php echo $index === 0 ? 'winner' : ''; ?>">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p>Total Votes: <strong><?php echo $row['vote_count']; ?></strong></p>
            <?php if ($index === 0): ?>
                <p style="color: #27ae60; font-weight: bold;">🏆 Winner!</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="logout-btn">
    <a href="logout.php">Logout</a>
</div>

</body>
</html>
