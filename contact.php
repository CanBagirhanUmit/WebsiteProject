<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webproje";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO contacts (name, email, message, date)
    VALUES ('$name', '$email', '$message',  '$date')";
  
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  $conn->close();
  


?>


<!DOCTYPE html>
<html>

<head>
    <title>Bize Ulaşın - OyunSatış</title>
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
        <nav>

            <ul>

                <li><a href="index.php">Anasayfa</a></li>
                <li><a href="games.php">Oyunlar</a></li>
                <li><a href="about.php">Hakkımızda</a></li>
                <li><a href="contact.php">Bize Ulaşın</a></li>

                <div style="width: 500px;">
                    <form action="contact.php" method="GET" autocomplete="off">
                        <br>
                        <input type="text" name="search" placeholder="Oyun Ara...">
                        <?php if(isset($_GET['search'])): ?>
                        <button type="button"
                            onclick="window.location.href=window.location.origin + window.location.pathname">Aramayı
                            Sıfırla</button>
                        <?php else: ?>
                        <button type="submit">Ara</button>
                        <?php endif; ?>

                </div>
                <?php

if(isset($_GET['search'])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webproje";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

// Arama sorgusunu al
    $search_query = $_GET['search'];

    if (!empty($search_query)) {
 // Arama sorgusuyla eşleşen oyunları arayın
        $sql = "SELECT * FROM games WHERE name LIKE '%$search_query%'";
        $result = mysqli_query($conn, $sql);

// Arama sonuçlarını görüntüle
        if(mysqli_num_rows($result) > 0) {
            echo "<br><br>";
            echo "<div class=\"games\">";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class=\"game\" style=\"height:325px;width:255px;\">"; 
                echo "<a href=\"" . $row["link"] . "\">";
                echo "<img src=\"uploads/".$row["img"]."\" alt=\"".$row["name"]."\">";
                echo "</a>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<br><br>";
            echo "<div class=\"games\">";
            echo "<div class=\"game1\">";
            echo "Aradığınız oyun bulunamadı.";
            echo "</div>";
            echo "</div>";
        }


        mysqli_close($conn);
    } else {
        echo "<br><br>";
        echo "<div class=\"games\">";
        echo "<div class=\"game1\">";
        echo "Lütfen bir oyun adı girin.";
        echo "</div>";
        echo "</div>";
    }
}
?>


                </form>



            </ul>


        </nav>
        <div class="container1">

            <div class="cart">
                <a href="cart.php"><img src="photos/cart.png" alt="Sepetim"></a>
            </div>


        </div>
        <div class="nav1">

            <div class="profile2">

                <?php

?>

                <?php

session_start();


if (!isset($_SESSION["id"])) {
header("Location: login.php");
exit();
}


$conn = mysqli_connect("localhost", "root", "", "webproje");

// Kullanıcının oturum kimliği ile ilişkili kullanıcı adını al
$id = $_SESSION["id"];
$sql = "SELECT username FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$username = $row['username'];


// Kullanıcı bilgilerini görüntüleyin
echo "<span style='font-size: 20px; padding-left: 55px;'>" . $username . " :</span><br>";

?>
                <div class="profile1">
                    <a href="profile.php">Profil</a>


                    <br>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <button type="submit" name="logout">Çıkış</button>

                        <?php


if (!isset($_SESSION['id'])) {
header('Location: login.php'); 
exit();
}


if (isset($_POST['logout'])) {
// kullanıcının durumunu "logout" olarak güncelle ve en son logout tarih saatini ayarla
$id = $_SESSION['id'];
$query = "UPDATE users SET logout = NOW() WHERE id='$id'";
mysqli_query($conn, $query); 

// oturum değişkenlerinin ayarını kaldırın ve oturumu yok edin
session_unset();
session_destroy();

header('Location: login.php'); 
exit();
}
?>
                    </form>


                </div>





            </div>


            <div class="profile">

                <?php

// Kullanıcının img değerini veritabanından al
$conn = mysqli_connect("localhost", "root", "", "webproje");
$id = $_SESSION["id"];
$sql = "SELECT img FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$img = $row['img'];

// Kullanıcının profil resmini görüntüle
if ($img) {
echo "<li><a href='profile.php'><img src='useruploads/$img' alt='Profile'></a></li>";
} else {
echo "<li><a href='profile.php'><img src='photos/profile.png' alt='Profile'></a></li>";
}
?>
            </div>
        </div>
        <div class="logo1">
            <a href="https://www.instagram.com/canbagirhanumit/"><img src="photos/instagram.png"
                    style="width: 40px; height: 40px;"></a>
        </div>
    </header>
    <br> <br> <br> <br><br><br><br>
    <script>
    window.onbeforeunload = function() {
        window.scrollTo(0, 0);
    }
    </script>
    <main>
        <section>

            <div class="signup-container9">

                <form action="" method="POST">

                    <h2>Bize Ulaşın</h2>

                    <p>Bize bir sorunuz, yorumunuz veya öneriniz mi var? Aşağıdaki formu doldurun, size en kısa
                        sürede
                        geri
                        dönüş yapalım.</p>
                    <br><br>
                    <div class="container" style="width:500px">
                        <form action="" method="POST">

                            <label for="name">İsim:</label>
                            <input type="text" id="name" name="name" required>
                            <br><br>

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                            <br><br>

                            <label for="message">Mesaj:</label>
                            <textarea id="message" name="message" required></textarea>
                            <br><br>

                            <input type="submit" value="Onayla">
                            <br>
                    </div>
            </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 OyunSatış</p>
    </footer>

</body>

</html>