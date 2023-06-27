<?php


session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webproje";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

// E-posta ve kullanıcı adının veritabanında zaten var olup olmadığını kontrol edin
$email_check_query = "SELECT * FROM users WHERE email='$email' OR username='$username' LIMIT 1";
$result = mysqli_query($conn, $email_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) {
// E-posta veya kullanıcı adı mevcutsa, hata mesajını göster
    echo "<script>alert('Bu email adresi veya kullanıcı adı kullanılıyor.')</script>";
} else {
   // Kullanıcıyı veritabanına ekle
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if (mysqli_query($conn, $sql)) {
// Oturum değişkenlerini ayarlayın
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

 // Gösterge tablosuna yönlendir
        header("Location: index.php");
        exit();
    } else {

        echo '<br><br><br><br><br><br><br><br><div class="signup-container4"><div class="container" style="width:300px;"><div style="font-size: 20px; color: red;">' . "Error: " . $sql . "<br>" . mysqli_error($conn) . '</div></div></div>';

    }
}
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Kayıt Ol - GameSatış</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>

<body>

    <header>



        <div class="container">
            <div class="logo">
                <a href="index.php"><img src="photos/icon.png"></a>
            </div>
        </div>
        <br>

        <div class="container1">


        </div>

        </div>




        <br><br><br><br><br><br>


    </header>
    <br><br><br><br><br><br><br><br><br><br><br> <br><br><br><br>
    <div class="signup-container4">


        <h2>Kayıt Ol</h2>

        <div class="container" style="width:300px">
            <form method="POST">
                <div class="form-group">
                    <label for="username">Kullanıcı Adı:</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Şifre:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail Adresi:</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <div class="container">
                        <br>
                        <button type="submit">Kayıt Ol</button>
                    </div>
                    <br><br>

                    <p>Hesabın var mı?</p>

                    <a href="login.php" class="btn">Giriş Yap</a>

                </div>
        </div>
    </div>

    </form>

    </div>

    <footer>
        <p>&copy; 2023 OyunSatış</p>
    </footer>

</body>

</html>