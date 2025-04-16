<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){
    // Step 1: Take raw input from user
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Step 2: Construct SQL query by directly injecting user input
    // ⚠️ WARNING: This is vulnerable to SQL injection
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    // Step 3: Debug output to see final SQL query (for learning only)
    echo "<strong>Executed SQL:</strong> $query<br><br>";

    // Step 4: Execute query
    $result = mysqli_query($conn, $query);

    // Step 5: If query fails (invalid SQL), show error
    if(!$result){
        echo "SQL Error: " . mysqli_error($conn);
        exit;
    }

    // Step 6: If query returns a row, user is logged in
    if(mysqli_num_rows($result) > 0){
        echo "<h3>✅ Logged in as: $username</h3>";
        echo "<h4>Showing all returned users:</h4>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "🧑‍💻 ID: " . $row["id"] . " | Username: " . $row["username"] . " | Password: " . $row["password"] . "<br>";
        }
    } else {
        echo "<div class='error'>❌ Invalid Credentials!</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voting System Login (Insecure)</title>
    <style>
        body {
            background: linear-gradient(to bottom right, #f0f8ff, #dceeff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .login-container {
            background-color: white;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 100, 0.15);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #0044cc;
            margin-bottom: 25px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #b0cfff;
            border-radius: 6px;
            font-size: 14px;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #0044cc;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0033aa;
        }
        .error {
            margin-top: 20px;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login to Voting System</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="text" name="password" placeholder="Password"><br>
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
</html>
