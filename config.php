<?php


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "webproje";


$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


mysqli_set_charset($conn, "utf8mb4");

?>