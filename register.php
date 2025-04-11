<!-- Step 3: register.php -->
<?php include 'config.php'; ?>
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit" name="register">Register</button>
</form>

<?php
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // For secure version: use password_hash()

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($query)) {
        echo "Registered Successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
