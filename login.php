<?php
/*
include 'config.php';
session_start();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vulnerable Query (No Validation)
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['username'] = $username;
        header('Location: vote.php');
    } else {
        echo "Invalid Credentials!";
    }
}
*/
?>

<!-- Existing HTML form -->
<!-- <h2>Login Page</h2>
<form method="post">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="text" name="password"><br><br>
    <input type="submit" name="submit" value="Login">
</form> -->


<!-- #vulnerable version -->

<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    
    $result = mysqli_query($conn, $query);

    if(!$result){
        echo "SQL Error: " . mysqli_error($conn);
        exit;
    }

    if(mysqli_num_rows($result) > 0){
        $_SESSION['username'] = $username;
        header('Location: vote.php');
    } else {
        echo "Invalid Credentials!";
    }
}
?>

<h2>Login Page</h2>
<form method="post">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="text" name="password"><br><br>
    <input type="submit" name="submit" value="Login">
</form>
