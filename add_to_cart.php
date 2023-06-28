<?php
session_start();


if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

// POST isteğinden oyun kimliğini al
$gameId = $_POST["game_id"];

// Oyunu veritabanında kullanıcının sepetine ekleyin
$conn = mysqli_connect("localhost", "root", "", "webproje");
$userId = $_SESSION["id"];
$sql = "INSERT INTO cart (user_id, game_id) VALUES ('$userId', '$gameId')";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);

// İstemciye bir başarı yanıtı döndür
echo "success";
?>