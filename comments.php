<?php
include 'config.php'; // DB connection
include 'navbar.php'; 
// Insert comment
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";
    if (!$conn->query($sql)) {
        die("Error inserting comment: " . $conn->error);
    }
}

// Get all comments
$comments = $conn->query("SELECT * FROM comments ORDER BY id DESC");
$secure = isset($_GET["secure"]); // Add ?secure=1 to enable secure mode
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XSS Demo (<?php echo $secure ? "Secure" : "Insecure"; ?> Mode)</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom right, #eef7ff, #ffffff);
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 600px;
            text-align: center;
        }
        h2 {
            color: #024fd1;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        input[type="text"], textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            resize: vertical;
        }
        button {
            background-color: #0066ff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0051cc;
        }
        .comments {
            margin-top: 30px;
            text-align: left;
        }
        .comment {
            background: #f5f9ff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .switch-links {
            margin-top: 20px;
        }
        .switch-links a {
            text-decoration: none;
            color: #0066ff;
            margin: 0 10px;
            font-weight: bold;
        }
        hr {
            margin: 30px 0;
            border: none;
            border-top: 1px solid #ddd;
        }
        <style>
    .mode-switch {
        margin-top: 30px;
        text-align: center;
    }

    .mode-switch button {
        background-color: #0056ff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .mode-switch button:hover {
        background-color: #0041cc;
    }
    </style>
</head>
<body>

<div class="container">
    <h2>💬 Leave a Comment (<?php echo $secure ? "Secure" : "Vulnerable"; ?> Mode)</h2>

    <form method="POST" action="">
        <input type="text" name="name" placeholder="Your Name" required>
        <textarea name="comment" placeholder="Your Comment..." rows="4" required></textarea>
        <button type="submit">Submit</button>
    </form>

    <hr>

    <div class="comments">
        <h3>📝 All Comments:</h3>
        <?php while ($row = $comments->fetch_assoc()): ?>
            <div class="comment">
                <strong><?php echo $secure ? htmlspecialchars($row['name']) : $row['name']; ?></strong><br>
                <?php echo $secure ? nl2br(htmlspecialchars($row['comment'])) : nl2br($row['comment']); ?>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="mode-switch">
    <?php if ($secure): ?>
        <form method="get">
            <button type="submit">⚠️ Switch to Insecure Mode</button>
        </form>
    <?php else: ?>
        <form method="get">
            <input type="hidden" name="secure" value="1">
            <button type="submit">🔐 Switch to Secure Mode</button>
        </form>
    <?php endif; ?>
</div>
</div>

</div>

</body>
</html>
