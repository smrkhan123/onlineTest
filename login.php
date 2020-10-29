<?php
require "config.php";
session_start();

//checking if user is already logged in or not

if (isset($_SESSION['id'])) {
    if($_SESSION['role'] == 'admin'){
        header("location: admin/index.php");
    }
    else{
        header("location: dashboard.php");
    }
}
$error = '';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $qry = "SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password'";
    $run = mysqli_query($conn, $qry);
    $row = mysqli_num_rows($run);
    if ($row<1) {
        $error = 'Please enter a valid Username or Password';
    } else {
        $data = mysqli_fetch_assoc($run);
        $id = $data['id'];
        $username = $data['username'];
        $role = $data['role'];
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        if($_SESSION['role'] == 'admin'){
            header("location: admin/index.php");
        }
        else{
            header("location: dashboard.php");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="wrapper">
        <div id="login-form">
            <h2>Login</h2>
            <div>
                <p id="errors"><?php echo $error; ?></p>
            </div>
            <form action="" method="POST">
                <p>
                    <label for="username">Username: <input type="text" name="username" required></label>
                </p>
                <p>
                    <label for="password">Password: <input type="password" name="password" required></label>
                </p>
                <p>
                   Do not have account? <a href="register.php">Register Here</a>
                </p>
                <p>
                    <input type="submit" name="submit" value="Login">
                </p>
            </form>
        </div>
    </div>
    </div>
</body>
</html>