<!DOCTYPE html>
<html>
<?php

session_start();

// Kullanıcının oturum açıp açmadığını ve yönetici olup olmadığını kontrol edin
if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit;
}
?>

<head>
    <title>Admin Paneli - GameSatış</title>
    <link rel="stylesheet" type="text/css" href="style_admin.css">
</head>

<body>
    <br> <br> <br> <br>
    <div class="signup-container4">
        <h1>Admin Paneli - GameSatış</h1>
        <form>
            <div class="container">
                <ul>
                    <li><a href=" admin_users.php">Kayıtlı Kullanıcılar</a></li>
                    <li><a href="admin_games.php">Satılan Oyunlar</a></li>
                    <li><a href="admin_contacts.php">Alınan Mesajlar</a></li>
                    <li><a href="admin_orders.php">Aktif Siparişler</a></li>
                    <li><a href="admin_ordersold.php">Geçmiş Siparişler</a></li>
                    <br> <br> <br> <br>
                    <li><a href="admin_login.php" style="background-color:red;">Çıkış</a></li>
            </div>

            </ul>
        </form>
    </div>
</body>

<style>
form {
    margin: auto;
    width: 50%;
    padding: 20px;

    border-radius: 10px;
}


body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}


h1 {
    text-align: center;
    font-size: 36px;
    margin-top: 50px;
}


p {
    text-align: center;
    font-size: 24px;
    margin-top: 20px;
}


ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align: center;
}

ul li {

    width: 150px;
    display: inline-block;
    margin: 10px;
}

ul li a {
    display: block;
    background-color: #4CAF50;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    border-radius: 10px;
}

ul li a:hover {
    background-color: #45a049;
}


.logout {
    text-align: center;
    margin-top: 20px;
}

.logout a {
    display: inline-block;
    background-color: #f44336;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    border-radius: 10px;
}

.logout a:hover {
    background-color: #d32f2f;
}

.container {
    margin: auto;
    position: relative;
    width: 500px;
    text-align: center;
}
</style>

</html>