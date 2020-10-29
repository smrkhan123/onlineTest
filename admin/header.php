<?php
include('../config.php');
$filename = basename($_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin/Index</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body{
            background-image:url('../images/quiz.jpg'); 
        }
    </style>
</head>
<body class="main_page">
    <div id="wrapper">
    <div class="navbar">
        <ul>
            <li><a href="index.php" <?php if($filename == 'index.php' || $filename == ''){ echo ' class="active" '; }?>>Home</a></li>
            <li class="right"><a href="../logout.php">Logout</a></li>
            <li class="right"><a href="questions.php" <?php if($filename == 'questions.php' || $filename == 'addquestions.php' ){ echo ' class="active" '; }?>>Manage Questions</a></li>
            <li class="right"><a href="users.php" <?php if($filename == 'users.php'){ echo ' class="active" '; }?>>Manage Users</a></li>
        </ul>
    </div>