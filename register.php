<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register | Voting System</title>
    <style>
        body {
            background: linear-gradient(to right, #e0f0ff, #ffffff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-box {
            background: white;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 150, 0.2);
            width: 350px;
            text-align: center;
        }

        .register-box h2 {
            color: #0033cc;
            margin-bottom: 25px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccdfff;
            border-radius: 6px;
            font-size: 15px;
        }

        button {
            background-color: #0055ff;
            color: white;
            padding: 12px 18px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
        }

        button:hover {
            background-color: #003bb3;
        }

        .message {
            margin-top: 15px;
            font-size: 15px;
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2>User Registration</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Enter Username" required><br>
        <input type="password" name="password" placeholder="Enter Password" required><br>
        <button type="submit" name="register">Register</button>
    </form>

    <?php
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password']; // Vulnerable version (no hashing)

        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($query)) {
            echo "<div class='message'>✅ Registered Successfully!</div>";
            header('Location: vote.php');
        exit;
        } else {
            echo "<div class='error'>❌ Error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>

</body>
</html>
