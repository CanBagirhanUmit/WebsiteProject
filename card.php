<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
    <script>
    function validateForm() {
        var username = document.forms["editProfile"]["username"].value;
        var email = document.forms["editProfile"]["email"].value;
        var password = document.forms["editProfile"]["password"].value;

        if (username == "") {
            alert("Username must be filled out");
            return false;
        }

        if (email == "") {
            alert("Email must be filled out");
            return false;
        }

        if (password == "") {
            alert("Password must be filled out");
            return false;
        }

        return true;
    }
    </script>
</head>

<body>


    <?php

 
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

// Formun gönderilip gönderilmediğini kontrol edin
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Kullanıcının bilgilerini formdan al
        $id = $_POST["id"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $card_no = $_POST["card_no"];

// Yeni bir resim dosyasının yüklenip yüklenmediğini kontrol edin
  if (!empty($_FILES["img"]["name"])) {
    $img = basename($_FILES["img"]["name"]);
    $img_tmp = $_FILES["img"]["tmp_name"];
    $img_ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $img_new = uniqid() . "." . $img_ext;
// Dosyayı "uploads" dizinine yükleyin
        move_uploaded_file($img_tmp, "useruploads/" . $img_new);

   // Veritabanındaki "img" alanını yeni dosya adıyla güncelleyin
    $sql = "UPDATE users SET username='$username', email='$email', password='$password', card_no='$card_no', img='$img_new' WHERE id='$id'";
} else {
   // Yeni bir resim yüklenmemişse, yalnızca diğer alanları güncelleyin
    $sql = "UPDATE users SET username='$username', email='$email', password='$password', card_no='$card_no' WHERE id='$id'";
}
        if (mysqli_query($conn, $sql)) {
            echo "Profile updated successfully.";
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }


   
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $sql);

   
    if (mysqli_num_rows($result) == 1) {
        while($row = mysqli_fetch_assoc($result)) {
            

    $_SESSION["id"] = $row["id"];
    
    $_SESSION["username"] = $row["username"];
    $_SESSION["card_no"] = $row["card_no"];
    $_SESSION["last_edit"] = $row["last_edit"];

    $id = $row["id"];
    $username = $row["username"];
    $email = $row["email"];
    $password = $row["password"];
    $card_no = $row["card_no"];
    $img = $row["img"];

    $sql = "UPDATE users SET last_edit=NOW() WHERE id='$id'";
    mysqli_query($conn, $sql);
        

        }
    } else {
        echo "No user found.";
    }

    mysqli_close($conn);
    ?>


    <!-- Kullanıcının bilgilerini düzenlemesine izin veren HTML formu -->
    <div class="signup-container4">
        <div class="signup-container">
            <div class="container">
                <?php
// Kullanıcının img değerini veritabanından al
        $conn = mysqli_connect("localhost", "root", "", "webproje");
        $id = $_SESSION["id"];
        $sql = "SELECT img FROM users WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $img = $row['img'];

   // Kullanıcının profil resmini görüntüle
        if (!empty($img)) {
            echo "<td><img src='useruploads/$img' width='150px' height='150px'></td>";
          } else {
            echo "<td><img src='photos\profile.png' width='150px' height='175px'></td>";
          }
        ?>

                <div class="form1">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
                        enctype="multipart/form-data">

                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <h2>Profil:</h2>
                        <label for="username">Kullanıcı Adı:</label>
                        <input type="text" name="username" value="<?php echo $username; ?>" required>
                        <label for="email">E-Mail Adresi:</label>
                        <input type="text" name="email" value="<?php echo $email; ?>" required>
                        <label for="password">Şifre:</label>
                        <input type="password" name="password" value="<?php echo $password; ?>" required>

                        <label for="card_no">Kart No:</label>
                        <input type="text" id="card_no" name="card_no" value="<?php echo $card_no; ?>" required
                            minlength="16" maxlength="16" pattern="[0-9]*">
                        <br>

                        <label for="img">Profil Resmi:</label>
                        <br>
                        <input type="file" name="img">
                        <br><br>
                        <input type="submit" value="Kaydet">
                        <br><br>
                        <button type="button" onclick="window.location.href='index.php'">Geri Dön</button>



                    </form>
                </div>

            </div>


        </div>
    </div>

    <br> <br><br> <br><br> <br><br> <br>

    <?php

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}


$user_id = $_SESSION["id"];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webproje";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "UPDATE orders SET status='Sipariş Kullanıcı Tarafından İptal Edildi', last_edit=NOW() WHERE id=$id AND status='Beklemede'";
    mysqli_query($conn, $sql);
    
   // Kullanıcı tarafından iptal edilen ve 5 dakika eski olan emirleri sil
    $sql = "DELETE FROM orders WHERE status='Sipariş Kullanıcı Tarafından İptal Edildi' AND last_edit < DATE_SUB(NOW(), INTERVAL 5 MINUTE)";
    mysqli_query($conn, $sql);
}


$sql = "SELECT id, user_id, game_id, game_name, game_price, status, date, last_edit 
        FROM orders 
        WHERE user_id = $user_id 
        AND status NOT IN ('Gönderildi', 'İptal Edildi (Stokta Kalmadı)') 
        AND (status != 'Sipariş Kullanıcı Tarafından İptal Edildi' 
        OR last_edit > DATE_SUB(NOW(), INTERVAL 5 MINUTE))
        OR (status IN ('Gönderildi', 'İptal Edildi (Stokta Kalmadı)') 
        AND last_edit > DATE_SUB(NOW(), INTERVAL 5 MINUTE))";

$result = mysqli_query($conn, $sql);


echo "<div class=\"signup-container4\">";
echo "<div class=\"signup-container8\">";

echo "<h2>Siparişler:</h2>";
echo "<table>";
echo "<tr>

    <th>Oyun Adı</th>
    <th>Fiyat</th>
    <th>Durum</th>
    <th>İptal</th>

</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr";
    if ($row["status"] == "Beklemede") {
        echo " style=\"color:yellow\"";
    } elseif ($row["status"] == "Gönderildi") {
        echo " style=\"color: green;\"";
    } elseif ($row["status"] == "İptal Edildi (Stokta Kalmadı)") {
        echo " style=\"color: red;\"";
    }
    echo ">
        <td>" . $row["game_name"] . "</td>
        <td>₺" . $row["game_price"] . "</td>
        <td>".$row["status"]."</td>";
    if ($row["status"] != "Gönderildi" && $row["status"] != "İptal Edildi (Stokta Kalmadı)" && $row["status"] != "Sipariş Kullanıcı Tarafından İptal Edildi") {
        echo "<td><a href=\"" . $_SERVER['PHP_SELF'] . "?delete=" . $row['id'] . "\" class=\"action-btn delete-btn yeni-sinif\">Siparişi İptal Et</a></td>";

    } else {
        echo "<td></td>";
    }
    echo "</tr>";
}

echo "</table>";
echo "</div>";
echo "</div>";

mysqli_close($conn);


?>

    <footer>

        <p>&copy; 2023 OyunSatış</p>

    </footer>

</body>

</html>