<?php
include('config.php');
session_start();
if (isset($_SESSION['id'])) {
    if($_SESSION['role'] == 'admin'){
        header("location: admin/index.php");
    }
    else{
        header("location: index.php");
    }
}
$errors = array();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    if ($password != $password2) {
        $errors[] = array('input' => 'passsword', 'msg' => 'Password and Confirm Password did not macthed!'); 
    } else {
        $qry = "SELECT * FROM users";
        $run = mysqli_query($conn, $qry);
        $rows = mysqli_num_rows($run);
        if ($rows>0) {
            $flag = 0;
            while ($data = mysqli_fetch_assoc($run)) {
                if ($data['username'] == $username) {
                    $errors[] = array('input' => 'username', 'msg' => 'Username already exists!');
                    $flag = 1;
                } elseif ($data['email'] == $email) {
                    $errors[] = array('input' => 'Email', 'msg' => 'Email already exists!');
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                $insert = 'INSERT INTO users(`username`, `email`, `role`, `password`) VALUES("'.$username.'", "'.$email.'", "'.$role.'", "'.$password.'")';
                $run = mysqli_query($conn, $insert);
                    if (!$run) {
                    die("Some errror Occured". mysqli_error($conn));
                } else {
                    header("location: login.php");
                }
            }
        } else {
            $insert = 'INSERT INTO users(`username`, `email`, `role`, `password`) VALUES("'.$username.'", "'.$email.'", "'.$role.'", "'.$password.'")';
            $run = mysqli_query($conn, $insert);
            if (!$run) {
                die("Some errror Occured". mysqli_error($conn));
            } else {
                header("location: login.php");
            }
        } 
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Register
    </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="wrapper">
        <div id="signup-form">
            <h2>Sign Up</h2>
            <div id="errors">
                <?php if (sizeof($errors)>0) : ?>
                    <ul>
                        <?php foreach ($errors as $error):?>
                            <li><?php echo $error['msg']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <form action="" method="POST">
                <p>
                    <label for="username"><span>Username: </span><input type="text" name="username" required></label>
                </p>
                <p>
                    <label for="password"><span>Password: </span><input type="password" name="password" required></label>
                </p>
                <p>
                    <label for="password2"><span>Re-Password: </span><input type="password" name="password2" required></label>
                </p>
                <p>
                    <label for="email"><span>Email: </span><input type="email" name="email" required></label>
                </p>
                <p>
                    <label for="userrole"><span>User Role: </span>
                        <select name="role" class="role" required style="width: 175px; padding: 1px;">
                            <option value="">Select</option>
                            <option value="admin">Admin</option>
                            <option value="candidate">Candidate</option>
                        </select>
                    </label>
                </p>
                <p>
                    Already have account? <a href="login.php">Login Here</a>
                </p>
                <p>
                    <input type="submit" name="submit" value="Register">
                </p>
            </form>
        </div>
    </div>
</body>
</html>