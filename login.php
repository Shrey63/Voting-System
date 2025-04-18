
<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ✅ Step 1: Prepare the SQL statement (with placeholders)
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");

    // ✅ Step 2: Bind the parameters to the placeholders
    $stmt->bind_param("ss", $username, $password); // 'ss' means two strings

    // ✅ Step 3: Execute the statement
    $stmt->execute();

    // ✅ Step 4: Get the result set from the executed statement
    $result = $stmt->get_result();

    // ✅ Step 5: Check if a matching user was found
    if($result->num_rows > 0){
        $_SESSION['username'] = $username;
        echo "✅ Logged in successfully. Redirecting...";
        header('Location: vote.php');
        exit;
    } else {
        echo "<div class='error'>❌ Invalid Credentials!</div>";
    }

    // ✅ Step 6: Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure Login</title>
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
            width: 320px;
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
        <h2>Login Page (Secure)</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
</html>
