<!DOCTYPE html>
<html>

<head>
    <title>Ödeme - OyunSatış</title>
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
                    <form action="payment.php" method="GET" autocomplete="off">
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
            <div class="signup-container7">
                <div class="container">

                    <?php
$total_price = 0;

if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $game) {
        $price = $game['price'];
        if(isset($game['quantity']) && $game['quantity'] > 1){
            $price *= $game['quantity'];
        }
        $total_price += $price;
    }
}



    $sql = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) == 1) {
        while($row = mysqli_fetch_assoc($result)) {
            

    $_SESSION["id"] = $row["id"];
    
    $_SESSION["username"] = $row["username"];
    $_SESSION["card_no"] = $row["card_no"];

    $id = $row["id"];
    $username = $row["username"];
    $email = $row["email"];
    $password = $row["password"];
    
    $card_no = $row['card_no'];
    $card_name = $row['card_name'];
    $exp_date = $row['exp_date'];
    $cvc = $row['cvc'];
      
    $img = $row["img"];

    $sql = "UPDATE users SET last_edit=NOW() WHERE id='$id'";
    mysqli_query($conn, $sql);
        

        }
    } else {
        echo "No user found.";
    }



echo "<p class=\"total-price\">Toplam Fiyat: ₺".$total_price."</p>";
error_reporting(0);

    mysqli_close($conn);
?>
                </div>
            </div>
            <div class="signup-container7">
                <div class="container">
                    <div class="form1">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
                            enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <label for="email">Gönderilecek E-Mail Adresi:</label>
                            <input type="text" name="email" value="<?php echo $email; ?>" required
                                pattern="[a-zA-Z]{3}\d{0,10}" title="En az 3 harf ve en fazla 10 rakam girin">
                            <br> <br>
                            -------------------------------------


                            <label for="card_name">Kart Üzerinde Yazan İsim:</label>
                            <input type="text" id="card_name" name="card_name" value="<?php echo $card_name; ?>"
                                required minlength="1" maxlength="100">
                            <script>
                            document.getElementById("card_name").addEventListener("input", function(e) {
                                this.value = this.value.replace(/[^a-zA-Z\s]/g, "");
                            });
                            </script>


                            <label for="card_no">Kart No:</label>
                            <input type="text" id="card_no" name="card_no" value="<?php echo $card_no; ?>" required
                                minlength="16" maxlength="16" pattern="[0-9]*">
                            <script>
                            document.getElementById("card_no").addEventListener("input", function(e) {
                                this.value = this.value.replace(/[^\d]/g, "");
                            });
                            </script>



                            <label for="exp_date">Son Kullanma Tarihi:</label>
                            <input type="text" id="exp_date" name="exp_date" value="<?php echo $exp_date; ?>" required
                                pattern="(0[1-9]|1[0-2])/[0-9]{2}" placeholder="MM/YY" maxlength="5"
                                onkeyup="autoSlash(this)" oninput="this.value = this.value.replace(/[^0-9\/]/g, '');"
                                onchange="validateMonthYear(this);">

                            <script>
                            function autoSlash(input) {
                                // sayısal olmayan karakterleri değiştirin
                                var val = input.value.replace(/\D/g, '');

                                // 2 rakamdan sonra eğik çizgi ekleyin
                                if (val.length > 2) {
                                    input.value = val.slice(0, 2) + '/' + val.slice(2);
                                } else {
                                    input.value = val;
                                }
                            }

                            function validateMonthYear(input) {
                                var expDate = input.value.split('/');
                                var expMonth = expDate[0];
                                var expYear = expDate[1];

                                if (parseInt(expMonth) > 12) {
                                    input.setCustomValidity('Geçersiz ay');
                                } else if (parseInt(expYear) < 23) {
                                    input.setCustomValidity('Kart son kullanma tarihi geçersiz');
                                } else {
                                    input.setCustomValidity('');
                                }
                            }
                            </script>


                            <label for="cvc">CVC:</label>
                            <input type="text" id="cvc" name="cvc" value="<?php echo $cvc; ?>" required
                                pattern="[0-9]{3}" maxlength="3" onkeypress="return isNumberKey(event)">

                            <script>
                            function isNumberKey(evt) {
                                var charCode = (evt.which) ? evt.which : event.keyCode;
                                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                                    return false;
                                }
                                return true;
                            }
                            </script>

                            <p> (Eğer Kartınızı Değiştirmek İstiyorsanız
                                Lütfen Profilinizden Kart Bilgilerinizi Güncelleyiniz) </p>

                        </form>

                    </div>
                </div>
            </div>


            <div class="signup-container6">

                <form action="payment.php" method="POST">
                    <button type="submit" name="buy_all" value="Buy All">Öde ve Sipariş Oluştur</button>


            </div>
            <?php


session_start();


if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['buy_all'])) {


    $conn = mysqli_connect("localhost", "root", "", "webproje");

  
    $sql_user = "SELECT * FROM users WHERE id=$id";
    $result_user = mysqli_query($conn, $sql_user);
    $row_user = mysqli_fetch_assoc($result_user);
    $email = $row_user['email'];

// Oyun bilgilerini oturum arabasından al
    $games = $_SESSION['cart'];

// Gerekli tüm kart bilgilerinin mevcut olup olmadığını kontrol edin
    $card_name = $row_user['card_name'];
    $card_no = $row_user['card_no'];
    $exp_date = $row_user['exp_date'];
    $cvc = $row_user['cvc'];

    if($card_name == "" || $card_no == "" || $exp_date == "" || $cvc == "") {
        echo '<div class="signup-container6"><p>Lütfen Kart Bilgilerinizi Profilden Güncelleyin</p></div>';

    } else {
 // Sipariş bilgilerini siparişler tablosuna ekleyin
        foreach($games as $game) {
            $game_id = $game['id'];
            $game_name = $game['name'];
            $game_price = $game['price'];
            $quantity = $game['quantity'];
            $user_id = $id;
            $date = date('Y-m-d H:i:s');
            $status = "Beklemede";
            $card_no = $row_user['card_no'];
            $card_name = $row_user['card_name'];
            $exp_date = $row_user['exp_date'];
            $cvc = $row_user['cvc'];

          // Miktar bazında birden fazla sipariş oluşturun
            for($i = 0; $i < $quantity; $i++) {
                $sql = "INSERT INTO orders (user_id, username, game_id, game_name, game_price, email,card_no,card_name,exp_date,cvc, date, status) VALUES ('$user_id', '$username', '$game_id', '$game_name', '$game_price', '$email','$card_no','$card_name','$exp_date','$cvc', '$date', '$status')";
                mysqli_query($conn, $sql);
            }
        }

// Sepetteki tüm öğeleri kaldır
        unset($_SESSION['cart']);
    }

    mysqli_close($conn);
}

?>

            </form>








            <h2>Sepetim</h2>

            <div class="games">

                <?php
    


if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $game) {

        echo "
  
      
        <div class=\"game\">

                <img src=\"uploads/".$game['img']."\" alt=\"".$game['name']."\">
                <h3>".$game['name']."</h3>
                <p class=\"price\">₺".$game['price']."</p>
                <p class=\"quantity\">Adet: ".$game['quantity']."</p>
                
                <form name=\"deleteForm".$game['id']."\" action=\"payment.php\" method=\"POST\">
                    <input type=\"hidden\" name=\"game_id\" value=\"".$game['id']."\">
               
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