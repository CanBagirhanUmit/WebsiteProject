<!DOCTYPE html>
<html>


<head>
    <title>Dishonored 2 - GameSatış</title>
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

                <div style="width: 500px;  font-family: Agent Orange;
font-weight: normal;
font-style: normal;">
                    <form action="dishonored2.php" method="GET" autocomplete="off">
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
            echo "<div class=\"games\">";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class=\"game\">";
                echo "<a href=\"" . $row["link"] . "\">";
                echo "<img src=\"uploads/".$row["img"]."\" alt=\"".$row["name"]."\">";
                echo "</a>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<div class=\"games\">";
            echo "<div class=\"game1\">";
            echo "Aradığınız oyun bulunamadı.";
            echo "</div>";
            echo "</div>";
        }


        mysqli_close($conn);
    } else {
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

    </header>
    <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br><br>
    <section class="hero2">

        <div class="signup-container5">

            <section>
                <h2>Hakkında</h2>
                <p>Dishonored, Arkane Studios tarafından geliştirilen ve Bethesda Softworks tarafından 2012 yılı
                    Ekim ayında yayınlanan birinci şahıs nişancı, aksiyon, macera türünde video oyunudur. Dünya
                    genelinde Microsoft Windows, PlayStation 3 ve Xbox 360 platformları için piyasaya sürüldü.
                    Oyun kurgusal, hastalıklı bir sanayi şehri olan Dunwall'da geçmektedir. Dishonored,
                    İmparatoriçenin koruması Corvo Attano'nun hikâyesini anlatmaktadır. Kendisi imparatoriçenin
                    öldürülmesinden sorumlu tutulmaktadır. Bir suikastçıya dönüşmeye mecbur bırakılan Corvo
                    kendisine komplo kuranlardan intikam almanın peşine düşecektir. Bu mücadelede ona Dunwall'ı
                    geri almak isteyen direnişçi Loyalists (Sadıklar, Sadakatliler) grubu ile Corvo'ya büyülü
                    yetenekler veren The Outsider (Dışlanmış) yardım etmektedir. Oyunun seslendirmesinde Susan
                    Sarandon, Brad Dourif, Carrie Fisher, Michael Madsen, Lena Headey ve Chloë Grace Moretz gibi
                    ünlü oyuncular yer almıştır.</p>

            </section>
        </div>



        <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webproje";
$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT * FROM games WHERE name='Dishonored 2'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
    echo "
    <div class=\"game\">
    <a href=\"".$row["link"]."\" class=\"game-link\">

                <img src=\"uploads/".$row["img"]."\" alt=\"".$row["name"]."\">

                <h3>".$row["name"]."</h3>
                
                <p class=\"price\">₺".$row["price"]."</p>
            </a>
        <form name=\"buyForm".$row["id"]."\" action=\"cart.php\" method=\"POST\">
            <input type=\"hidden\" name=\"game_id\" value=\"".$row["id"]."\">
            <input type=\"hidden\" name=\"game_name\" value=\"".$row["name"]."\">
            <input type=\"hidden\" name=\"game_price\" value=\"".$row["price"]."\">
            <input type=\"hidden\" name=\"game_img\" value=\"".$row["img"]."\">
            <button type=\"submit\" name=\"buy_now\" value=\"Buy Now\">Satın Al</button>
        </form>
        
        </div>";
}

mysqli_close($conn);
?>




        </div>







    </section>

    <script>
    window.onbeforeunload = function() {

        window.scrollTo(0, 0);

    }
    </script>


    <footer>

        <p>&copy; 2023 OyunSatış</p>

    </footer>

</body>

</html>