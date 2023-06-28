<!DOCTYPE html>
<html>

<head>
    <title>Sepetim - OyunSatış</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
                    <form action="cart.php" method="GET" autocomplete="off">
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
    <br> <br> <br> <br>
    <main>


        <script>
        const listContainer = document.getElementById("list-container");

        // Görüntülenecek öğelerin örnek dizisi
        const items = ["item 1", "item 2", "item 3", "item 4", "item 5"];

        // Öğeler arasında döngü yapın ve liste öğeleri oluşturun
        for (let i = 0; i < items.length; i++) {
            const item = items[i];

            const listItem = document.createElement("div");
            listItem.classList.add("list-item");
            listItem.textContent = item;

            listContainer.appendChild(listItem);
        }

        window.onbeforeunload = function() {

            window.scrollTo(0, 0);

        }
        </script>
        <br> <br> <br>
        <div class="signup-container4">

            <h2>Sepetim</h2>
            <div class="signup-container6">

                <?php
           
if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo "<a href='payment.php' class='btn1'>Hepsini Satın Al</a>";
} else {
    echo "<a href='games.php' class='btn1'>Sepetiniz Boş, Oyunlara Göz Atın</a>";
}
?>



            </div>


            <div class="games">

                <?php
                
                if(isset($_POST['delete'])) {
               // Sepetten oyunun bir kopyasını çıkarın
                    $game_id = $_POST['game_id'];
                    foreach($_SESSION['cart'] as $key => $game) {
                        if($game['id'] == $game_id) {
                   // Eğer oyunun birden fazla kopyası varsa, miktarı azalt
                            if($game['quantity'] > 1) {
                                $_SESSION['cart'][$key]['quantity']--;
                            } else {
                        // Oyunun yalnızca bir kopyası varsa, onu sepetten çıkarın
                                unset($_SESSION['cart'][$key]);
                            }
                        }
                    }
                }
                

if(isset($_POST['buy_now'])) {

    $game_id = $_POST['game_id'];
    $game_name = $_POST['game_name'];
    $game_price = $_POST['game_price'];
    $game_img = $_POST['game_img'];
    
// Oyunun zaten sepette olup olmadığını kontrol edin
    if(isset($_SESSION['cart'][$game_id])) {
// Oyun zaten sepetteyse, miktarı artırın
        $_SESSION['cart'][$game_id]['quantity']++;
    } else {
// Oyun sepette değilse, miktarı 1 artır
        $_SESSION['cart'][$game_id] = array(
            'id' => $game_id,
            'name' => $game_name,
            'price' => $game_price,
            'img' => $game_img,
            'quantity' => 1
        );
    }
}


// Seçili oyun(lar)ı görüntüle
if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $game) {
        echo "
        <div class=\"game\">
            <img src=\"uploads/".$game['img']."\" alt=\"".$game['name']."\">
            <h3>".$game['name']."</h3>
            <p class=\"price\">₺".$game['price']."</p>
            <p class=\"quantity\">Adet: ".$game['quantity']."</p>


            
            <form name=\"deleteForm".$game['id']."\" action=\"cart.php\" method=\"POST\">

                <input type=\"hidden\" name=\"game_id\" value=\"".$game['id']."\">


                <button type=\"submit\" name=\"delete\" value=\"Delete\">Sepetten Sil</button>
            </form>
        </div>";
    }
    
   
} else {
    echo "";
}


?>



            </div>

        </div>

    </main>
    <footer>
        <p>&copy; 2023 OyunSatış</p>
    </footer>

</body>


</html>