<!DOCTYPE html>
<html>

<head>
    <title>Oyunu Düzenle Admin Paneli - GameSatış</title>
    <link rel="stylesheet" type="text/css" href="style_admin.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    form {
        width: 400px;
        margin: 20px auto;

        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    h2 {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        margin-bottom: 20px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 22px;
    }

    input[type="submit"]:hover {
        background-color: #3e8e41;
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $link = $_POST["link"];
        $quantity = $_POST["quantity"];
    
  // Yeni bir resim dosyasının yüklenip yüklenmediğini kontrol edin
        if (!empty($_FILES["img"]["name"])) {
            $img = basename($_FILES["img"]["name"]);
            $img_tmp = $_FILES["img"]["tmp_name"];
            $img_ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            $img_new = uniqid() . "." . $img_ext;
    
            // Dosyayı "uploads" dizinine yükleyin
            move_uploaded_file($img_tmp, "uploads/" . $img_new);
    
            // Veritabanındaki "img" alanını yeni dosya adıyla güncelleyin
            $sql = "UPDATE games SET name='$name', price='$price', link='$link', quantity='$quantity', img='$img_new' WHERE id='$id'";
        } else {
            // Yeni bir resim yüklenmemişse, yalnızca diğer alanları güncelleyin
            $sql = "UPDATE games SET name='$name', price='$price', link='$link', quantity='$quantity' WHERE id='$id'";
        }
    
        if (mysqli_query($conn, $sql)) {
            echo "<p> Game updated successfully. </p>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    

    // Seçili ID için oyun verilerini al
    if(isset($_GET['id'])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM games WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    }      
    error_reporting(0);





    mysqli_close($conn);
    ?>

            <h2>Oyunu Düzenle:</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
                enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="name">Oyun Adı:</label>
                <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                <label for="price">Ücret:</label>
                <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" required>
                <label for="link">Link:</label>
                <input type="text" name="link" value="<?php echo $row['link']; ?>" required>
                <label for="quantity">Adet:</label>
                <input type="number" step="1" name="quantity" value="<?php echo $row['quantity']; ?>" required>
                <label for="img">Oyunun Resmi:</label>
                <br>
                <input type="file" id="img" name="img" accept="image/*">
                <br> <br> <br>
                <input type="submit" value="Güncelle">
            </form>


            <form method="get" action="admin_games.php">
                <input type="submit" value="Geri Dön" style="background-color:#8d181883;">
            </form>
        </div>
    </div>
</body>

</html>