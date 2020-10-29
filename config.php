<?php

$base_url = "localhost/training/onlineTest";

$host = "localhost";
$username = "root";
$password = "";
$dbname = "onlinetest";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection Failed: ". mysqli_connect_error($conn));
}

?>