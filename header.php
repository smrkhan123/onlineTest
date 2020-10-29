<?php
include('config.php');
$filename = basename($_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin/Index</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            background-image:url('images/quiz.jpg'); 
        }
    </style>
</head>
<body>
    <div id="wrapper">
    <div class="navbar">
        <ul class="list">
            <li><a class="active" href="dashboard.php">Quiz</a></li>
            <li class="right"><a href="logout.php">Logout</a></li>
        </ul>
    </div>