<?php
error_reporting(0);

session_start();


if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}


$id = $_SESSION["id"];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webproje";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM users WHERE id=$id";
$result = mysqli_query($conn, $sql);

// Kullanıcı bilgilerinin bulunup bulunmadığını kontrol edin
if (mysqli_num_rows($result) > 0) {
// Profile.php'den en son düzenlenmiş verileri al
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "User information updated successfully. ";
        echo "<a href='profile.php'>Go back to profile</a>";
    } else {
        echo "Error updating user information: " . mysqli_error($conn);
    }
} else {
    echo "No user found.";
}


mysqli_close($conn);
?>