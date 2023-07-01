<!DOCTYPE html>
<html>

<head>
    <title>Kullanıcı Düzenle Admin Paneli - GameSatış</title>
    <link rel="stylesheet" type="text/css" href="style_admin.css">
    <style>
    .container {
        margin: auto;
        position: relative;
        width: 500px;
        text-align: center;
    }

    form {
        margin-top: 20px;
        padding: 10px;


    }

    input[type=text],
    input[type=number],
    select,
    input[type=submit] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
    <div class="signup-container4">
        <div class="container">

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

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM users WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $card_no = $_POST["card_no"];
    $card_name = $_POST["card_name"];
    $exp_date = $_POST["exp_date"];
    $cvc = $_POST["cvc"];

    $id = $_POST["id"];
  
// Yeni bir resim dosyasının yüklenip yüklenmediğini kontrol edin
    if (!empty($_FILES["img"]["name"])) {
        $img = basename($_FILES["img"]["name"]);
        $img_tmp = $_FILES["img"]["tmp_name"];
        $img_ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $img_new = uniqid() . "." . $img_ext;

        // Dosyayı "uploads" dizinine yükleyin
        move_uploaded_file($img_tmp, "useruploads/" . $img_new);

        // Veritabanındaki "img" alanını yeni dosya adıyla güncelleyin
        $sql = "UPDATE users SET username='$username', email='$email', password='$password', card_no='$card_no', card_name='$card_name',  exp_date='$exp_date',  cvc='$cvc', img='$img_new' WHERE id='$id'";
    } else {
        // Yeni bir resim yüklenmemişse, yalnızca diğer alanları güncelleyin
        $sql = "UPDATE users SET username='$username', email='$email', password='$password', card_no='$card_no', card_name='$card_name',  exp_date='$exp_date',  cvc='$cvc' WHERE id='$id'";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<p>User updated successfully.</p>";

        // Güncellenmiş kullanıcı verilerini al
        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

    }
}

        
    
        // Seçili ID için oyun verilerini al
        if(isset($_GET['id'])) {
        $id = $_GET["id"];
        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        }      
        error_reporting(0);
    
    
    
    
    
        mysqli_close($conn);
        ?>
            <form>
                <img src="<?php echo 'useruploads/' . $row['img']; ?>" alt="User Image"
                    style="max-width: 200px; max-height: 200px; margin:auto;">
            </form>


            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
                enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <h2>Kullanıcıyı Düzenle:</h2>
                <label for="username">Kullanıcı Adı:</label>
                <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
                <label for="email">Email:</label>
                <input type="text" name="email" value="<?php echo $row['email']; ?>" required>
                <label for="password">Şifre:</label>
                <input type="text" name="password" value="<?php echo $row['password']; ?>" required>



                <label for="card_name">Kart Üzerinde Yazan İsim:</label>
                <input type="text" name="card_name" value="<?php echo $row['card_name']; ?>" minlength="1"
                    maxlength="100">
                <script>
                document.getElementById("card_name").addEventListener("input", function(e) {
                    this.value = this.value.replace(/[^a-zA-ZğüşıöçĞÜŞİÖÇ\s]/g, "");
                });
                </script>


                <label for="card_no">Kart No:</label>
                <input type="text" name="card_no" value="<?php echo $row['card_no']; ?>" minlength="16" maxlength="16"
                    pattern="[0-9]*">
                <script>
                document.getElementById("card_no").addEventListener("input", function(e) {
                    this.value = this.value.replace(/[^\d]/g, "");
                });
                </script>



                <label for="exp_date">Son Kullanma Tarihi:</label>
                <input type="text" name="exp_date" value="<?php echo $row['exp_date']; ?>"
                    pattern="(0[1-9]|1[0-2])/[0-9]{2}" placeholder="MM/YY" maxlength="5" onkeyup="autoSlash(this)"
                    oninput="this.value = this.value.replace(/[^0-9\/]/g, '');" onchange="validateMonthYear(this);">

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
                <input type="text" name="cvc" value="<?php echo $row['cvc']; ?>" pattern="[0-9]{3}" maxlength="3"
                    onkeypress="return isNumberKey(event)">

                <script>
                function isNumberKey(evt) {
                    var charCode = (evt.which) ? evt.which : event.keyCode;
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        return false;
                    }
                    return true;
                }
                </script>

                <br>






                <br><br>
                <label for="img">Profil Resmi:</label>
                <br> <br>
                <input type="file" id="img" name="img" accept="image/*">




                <br> <br>
                <input type="submit" value="Güncelle">
            </form>




            <form method="get" action="admin_users.php">
                <input type="submit" value="Geri Dön" style="background-color:#8d181883;">
            </form>

        </div>

    </div>
</body>

</html>