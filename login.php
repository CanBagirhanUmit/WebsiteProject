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


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];


    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) == 1) {
  
        $row = mysqli_fetch_assoc($result);
        $_SESSION["id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["last_login"] = $row["last_login"];

        $id = $row["id"];
        $sql = "UPDATE users SET last_login=NOW() WHERE id='$id'";
        mysqli_query($conn, $sql);

     
        header("Location: index.php?id=$id");
        exit();
    } else {
   
        echo '<br><br><br><br><br><br><br><br><div class="signup-container4"><div class="container" style="width:300px;"><div style="font-size: 20px; color: red;">' . "Invalid username or password." . '</div></div></div>';
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Giriş Yap - OyunSatış</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
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

    <main>
        <section>
            <br><br><br> <br><br><br><br><br><br>

            <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
            <?php endif; ?>

            <div class="signup-container4">


                <h2>Giriş Yap</h2>
                <div class="container" style="width:300px">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <label for="username">Kullanıcı Adı:</label>
                        <input type="text" id="username" name="username"><br>

                        <label for="password">Şifre:</label>
                        <input type="password" id="password" name="password"><br>
                        <br>
                        <input type="submit" value="Giriş Yap">
                    </form>
                    <br><br>
                    <div class="container">
                        <p>Hesabın yok mu?</p>




                    </div> <a href="register.php" class="btn">Kayıt ol</a>

                </div>
            </div>
        </section>

    </main>



    <footer>
        <p>&copy; 2023 OyunSatış</p>
    </footer>
</body>

</html>