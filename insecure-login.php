<?php
include 'config.php';
session_start();

$show_form = true;
$show_table = false;
$table_data = [];

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if(!$result){
        echo "SQL Error: " . mysqli_error($conn);
        exit;
    }

    $row_count = mysqli_num_rows($result);

    if($row_count > 0){
        if($row_count === 1){
            $_SESSION['username'] = $username;
            header("Location: vote.php");
            exit;
        } else {
            $show_form = false;
            $show_table = true;
            while($row = mysqli_fetch_assoc($result)) {
                $table_data[] = $row;
            }
        }
    } else {
        $error = "❌ Invalid Credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insecure Login</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(to bottom right, #eaf4ff, #d9e8f5);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 2rem;
        }

        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            color: #034efc;
            margin-bottom: 1.5rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        input[type="submit"] {
            width: 100%;
            padding: 0.75rem;
            background-color: #034efc;
            border: none;
            color: white;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #003bd4;
        }

        .error {
            margin-top: 1rem;
            color: red;
        }

        .warning {
            background-color: #ffe4e1;
            padding: 1rem;
            margin-top: 2rem;
            border: 1px solid #f5c2c2;
            border-radius: 8px;
            color: #a94442;
        }

        table {
            width: 100%;
            margin-top: 1rem;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 0.75rem;
            border: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #f2f7ff;
            color: #034efc;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Login Page</h2>

        <?php if(isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <?php if($show_form): ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="text" name="password" placeholder="Password" required>
            <input type="submit" name="submit" value="Login">
        </form>
        <?php endif; ?>

        <?php if($show_table): ?>
            <div class="warning">
                ⚠️ Multiple users matched! Possible SQL Injection detected.<br>
                Fetched <strong><?= count($table_data) ?></strong> records:
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($table_data as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['password']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
