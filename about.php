<!DOCTYPE html>
<html>

<head>
    <title>Hakkımızda - OyunSatış</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<br><br><br><br><br><br><br><br><br><br>

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
                    <form action="about.php" method="GET" autocomplete="off">
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


    $search_query = $_GET['search'];

    if (!empty($search_query)) {

        $sql = "SELECT * FROM games WHERE name LIKE '%$search_query%'";
        $result = mysqli_query($conn, $sql);

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


$id = $_SESSION["id"];
$sql = "SELECT username FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$username = $row['username'];


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

$id = $_SESSION['id'];
$query = "UPDATE users SET logout = NOW() WHERE id='$id'";
mysqli_query($conn, $query); 


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


$conn = mysqli_connect("localhost", "root", "", "webproje");
$id = $_SESSION["id"];
$sql = "SELECT img FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$img = $row['img'];


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
    <br><br><br><br>
    <div class="signup-container4">

        <main>
            <div class="container">
                <div class="logo2">
                    <img src="photos/icon.png">
                </div>
            </div>
            <section>

                <h2>Hakkımızda</h2>
                <p>OyunSatış, video oyunları ve oyun aksesuarlarının çevrimiçi perakendecisidir. Müşterilerimize en
                    iyi
                    oyun
                    seçeneklerini, en yeni sürümleri ve en rekabetçi fiyatları sunmak için çalışıyoruz. Oyun
                    uzmanlarından
                    oluşan ekibimiz, kendini birinci sınıf müşteri hizmeti ve desteği sağlamaya adamıştır.</p>
                <p>OyunSatış olarak, oyun oynamanın bir hobiden daha fazlası olduğuna inanıyoruz - bu bir yaşam
                    biçimidir.
                    Bu nedenle, müşterilerimizin oyun deneyimlerini bir üst seviyeye taşımak için ihtiyaç duydukları
                    oyunları ve ekipmanları bulmalarına yardımcı olma konusunda tutkuluyuz. İster sıradan bir oyuncu
                    ister
                    sıkı bir meraklı olun, oyun tutkunuzu beslemek için ihtiyacınız olan her şeye sahibiz.</p>
                <br><br><br><br><br>
            </section>
        </main>
    </div>
    <footer>
        <p>&copy; 2023 OyunSatış</p>
    </footer>
</body>

</html>