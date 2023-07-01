<!DOCTYPE html>
<html>

<head>
    <title>Kayıtlı Kullanıcılar Admin Paneli - GameSatış</title>
    <link rel="stylesheet" type="text/css" href="style_admin.css">
    <style>
    tr {
        font-size: 16px;

    }

    table {
        border-collapse: collapse;
        max-width: 100%;
    }


    td {

        border-radius: 5px;
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
        max-width: 200px;
        word-wrap: break-word;

    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    th {
        background-color: #4CAF50;
        color: white;
        max-width: 1920px;
        word-wrap: break-word;
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

    .action-btn {
        display: inline-block;
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .edit-btn {
        background-color: #2196F3;
    }

    .delete-btn {
        background-color: #f44336;
    }

    .action-btn:hover {
        background-color: #333;
    }


    .container {
        margin: auto;
        position: relative;
        width: 500px;
        text-align: center;
    }
    </style>
</head>

<body>
    <br>
    <div class="container">
        <form method="get" action="admin.php">
            <input type="submit" value="Ana Sayfaya Dön" style="background-color:#8d181883;">
        </form>
    </div>
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


    if(isset($_GET['delete'])) {
		$id = $_GET['delete'];
		$sql = "DELETE FROM users WHERE id=$id";
		mysqli_query($conn, $sql);
	}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = $_POST["username"];
		$email = $_POST["email"];
        $password = $_POST["password"];
        $card_no = $_POST["card_no"];
        $card_name = $_POST["card_name"];
        $exp_date = $_POST["exp_date"];
        $cvc = $_POST["cvc"];
        $img = $_FILES["img"]["name"];
        $target_dir = "useruploads/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

		$sql = "INSERT INTO users (username, email, password, card_no, card_name, exp_date, cvc, img) VALUES ('$username', '$email', '$password', '$card_no' , '$card_name' , '$exp_date','$cvc' ,'$img')";

		if (mysqli_query($conn, $sql)) {
			echo "<p>New user added successfully.</p>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
    

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    
    echo "<h2>Kayıtlı Kullanıcılar:</h2>";
    echo "</div>";
    echo "</div>";
 
    echo "<table>";
    echo "<tr><th>ID</th>
    <th>Kullanıcı Adı</th>
    <th>Email</th>
    <th>Şifre</th>
    <th>Kart No</th>
    <th>Kart Üzerinde Yazan İsim</th>
    <th>Son Kullanma Tarihi</th>
    <th>CVC</th>
    <th>Hesap Oluşturulma Tarihi</th>
    <th>Son Düzenleme</th>
    <th>Son Giriş</th>
    <th>Son Çıkış</th>
    <th>Profil Fotoğrafı</th>
    
    <th>Düzenle</th>
    <th>Sil</th>
    </tr>";
        
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["id"]."</td>
        <td>".$row["username"]."</td>
        <td>".$row["email"]."</td>
        <td>".$row["password"]."</td>
        <td>".$row["card_no"]."</td>
        <td>".$row["card_name"]."</td>
        <td>".$row["exp_date"]."</td>
        <td>".$row["cvc"]."</td>
        <td>".$row["date"]."</td>
        <td>".$row["last_edit"]."</td>
        <td>".$row["last_login"]."</td>
        <td>".$row["logout"]."</td>";
        
        echo "<td><img src='useruploads/" . $row["img"] . "' width='100'></td>";
        echo "<td><a href=\"admin_edit.php?id=".$row['id']."\" class=\"action-btn edit-btn\">Düzenle</a></td>";
        echo "<td><a href=\"".$_SERVER['PHP_SELF']."?delete=".$row['id']."\" class=\"action-btn delete-btn\">Sil</a></td>
        </tr>";
    }
   
    echo "</table>";
    echo "<br><br><br>";
    error_reporting(0);
	mysqli_close($conn);
	?>
        <div class="signup-container4">
            <div class="container">
                <form method="post" enctype="multipart/form-data" class="form1">
                    <h2>Yeni Kullanıcı Ekle:</h2>
                    <label for="username">Kullanıcı Adı:</label>
                    <input type="text" name="username" value="" required>


                    <label for="email">E-Mail Adresi:</label>
                    <input type="text" name="email" value="" required>

                    <label for="password">Şifre:</label>
                    <input type="text" name="password" value="" required>
                    <br> <br> <br>
                    <label for="img">Profil Resmi:</label>
                    <br><br><br>
                    <input type="file" id="img" name="img" accept="image/*">

                    <br> <br> <br>


                    <label for="card_name">Kart Üzerinde Yazan İsim:</label>
                    <input type="text" id="card_name" name="card_name" value="<?php echo $card_name; ?>" minlength="1"
                        maxlength="100">
                    <script>
                    document.getElementById("card_name").addEventListener("input", function(e) {
                        this.value = this.value.replace(/[^a-zA-ZğüşıöçĞÜŞİÖÇ\s]/g, "");
                    });
                    </script>


                    <label for="card_no">Kart No:</label>
                    <input type="text" id="card_no" name="card_no" value="<?php echo $card_no; ?>" minlength="16"
                        maxlength="16" pattern="[0-9]*">
                    <script>
                    document.getElementById("card_no").addEventListener("input", function(e) {
                        this.value = this.value.replace(/[^\d]/g, "");
                    });
                    </script>



                    <label for="exp_date">Son Kullanma Tarihi:</label>
                    <input type="text" id="exp_date" name="exp_date" value="<?php echo $exp_date; ?>"
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
                    <input type="text" id="cvc" name="cvc" value="<?php echo $cvc; ?>" pattern="[0-9]{3}" maxlength="3"
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

                    <br> <br>



                    <input type="submit" value="Ekle">


                </form>
            </div>
        </div>

</body>

</html>