<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    echo "Please login first.";
    exit;
}

$username = $_SESSION['username'];

$user_result = $conn->query("SELECT id FROM users WHERE username = '$username'");
if ($user_result && $user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $uid = $user_row['id'];
} else {
    echo "User not found.";
    exit;
}

// Handle voting
$message = "";
if (isset($_GET['vote_id'])) {
    $cid = $_GET['vote_id']; // 🔓 Vulnerable line
    $vote_result = $conn->query("INSERT INTO votes (user_id, candidate_id) VALUES ('$uid', '$cid')");

    if ($vote_result) {
        $message = "<div class='success'>🗳️ Voted Successfully! <a href='results.php'>View Results</a></div>";
    } else {
        $message = "<div class='error'>❌ Error voting: " . $conn->error . "</div>";
    }
}

$candidates = $conn->query("SELECT * FROM candidates");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vote | Secure Voting System</title>
    <style>
        body {
            background: linear-gradient(to right, #e6f2ff, #ffffff);
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #0033cc;
            text-align: center;
        }

        .container {
            max-width: 900px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
            padding-top: 30px;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #cce0ff;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 100, 0.1);
        }

        .card h3 {
            color: #002b80;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .vote-btn {
            background-color: #0066ff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
        }

        .vote-btn:hover {
            background-color: #0047b3;
        }

        .success {
            background-color: #e0ffe0;
            color: green;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            font-weight: bold;
        }

        .error {
            background-color: #ffe0e0;
            color: red;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            font-weight: bold;
        }

        .top-bar {
            text-align: center;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .top-bar span {
            color: #0066cc;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="top-bar">
    Welcome, <span><?php echo htmlspecialchars($username); ?></span>! Cast your vote below.
</div>

<h2>Vote for a Candidate</h2>

<?php echo $message; ?>

<div class="container">
    <?php while ($row = $candidates->fetch_assoc()): ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <a class="vote-btn" href="vote.php?vote_id=<?php echo $row['id']; ?>">Vote</a>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
