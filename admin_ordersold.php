<!DOCTYPE html>
<html>

<head>
    <title>Geçmiş Siparişler Admin Paneli - GameSatış</title>
    <link rel="stylesheet" type="text/css" href="style_admin.css">
    <style>
    tr {
        font-size: 16px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
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
    }

    form {
        margin-top: 20px;
        padding: 10px;


    }

    input[type=text],
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

    <div class="container">
        <form method="get" action="admin.php">
            <input type="submit" value="Ana Sayfaya Dön" style="background-color:#8d181883;">
        </form>
    </div>
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
// Sil düğmesine tıklanıp tıklanmadığını kontrol edin
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM orders WHERE id=$id";
        mysqli_query($conn, $sql);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
    
// Bir siparişin durumunun güncellenip güncellenmediğini kontrol edin
if(isset($_POST['update_status'])) {
    $id = $_POST['order_id'];
    $status = $_POST['status'];
    $sql = "UPDATE orders SET status='$status', last_edit=NOW() WHERE id=$id";
    mysqli_query($conn, $sql);
}



	$sql = "SELECT id, user_id, username, email, game_id, game_name, game_price,card_no, card_name, exp_date, cvc, date, last_edit, status 
FROM orders 
WHERE status='Gönderildi' OR status='İptal Edildi (Stokta Kalmadı)' OR status='Sipariş Kullanıcı Tarafından İptal Edildi'";

	$result = mysqli_query($conn, $sql);

	echo "<h2>Geçmiş Siparişler:</h2>";
	echo "<table>";
	echo "<tr>
    <th>Sipariş ID</th>
    <th>Kullanıcı ID</th>
    <th>Kullanıcı Adı</th>
    <th>Email</th>
    <th>Oyun ID</th>
    <th>Oyun Adı</th>
    <th>Fiyat</th>
    <th>Kart No</th>
    <th>Kart Üzerinde Yazan İsim</th>
    <th>Son Kullanma Tarihi</th>
    <th>CVC</th>
    <th>Oluşturulma Tarihi</th>
    <th>En Son Değiştirilme Tarihi</th>
    <th>Durum</th>
    <th>İptal</th>
    </tr>";

	while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["user_id"]."</td>
                <td>".$row["username"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["game_id"]."</td>
                <td>".$row["game_name"]."</td>
                <td>₺".$row["game_price"]."</td>
                <td>".$row["card_no"]."</td>
        <td>".$row["card_name"]."</td>
        <td>".$row["exp_date"]."</td>
        <td>".$row["cvc"]."</td>
                <td>".$row["date"]."</td>
                <td>".$row["last_edit"]."</td>
                <td>";
      
       // Durumun şu olup olmadığını kontrol edin  "Sipariş Kullanıcı Tarafından İptal Edildi"
        if($row['status'] == 'Sipariş Kullanıcı Tarafından İptal Edildi') {
          echo $row['status'];
        } else {
// Durum açılır menüsünü görüntüle
          echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>
                  <input type='hidden' name='order_id' value='".$row['id']."'>
                  <select name='status'>
                    <option value='Beklemede'";
          if($row['status'] == 'Beklemede') {
            echo " selected";
          } else {
            echo "";
          }
          echo ">Beklemede</option>
                    <option value='Gönderildi'";
          if($row['status'] == 'Gönderildi') {
            echo " selected";
          }
          echo ">Gönderildi</option>
                    <option value='İptal Edildi (Stokta Kalmadı)'";
          if($row['status'] == 'İptal Edildi (Stokta Kalmadı)') {
            echo " selected";
          }
          echo ">İptal Edildi (Stokta Kalmadı)</option>
                  </select>
                  <input type='submit' name='update_status' value='Güncelle'>
                </form>";
        }
      
        echo "</td>
              <td><a href='".$_SERVER['PHP_SELF']."?delete=".$row['id']."' class='action-btn delete-btn'>İptal</a></td>
              </tr>";
      }
      
	echo "</table>";

	mysqli_close($conn);
?>


</body>


</html>