<?php

session_start();


$conn = mysqli_connect("localhost", "root", "", "webproje");

// Oturum açma formunun gönderilip gönderilmediğini kontrol edin
if(isset($_POST['login'])) {
// Formdan kullanıcı adı ve şifreyi al
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

   // Kullanıcının var olup olmadığını ve şifresinin doğru olup olmadığını kontrol etmek için admin tablosunu sorgula
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        // Kullanıcı varsa ve parola doğruysa, oturum değişkenlerini ayarlayın ve yönetici paneline yönlendirin
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['is_admin'] = true;
        header("Location: admin.php");
        exit;
    } else {
        // Kullanıcı mevcut değilse veya parola yanlışsa, bir hata mesajı görüntüleyin
        $error = "";
        // Varsa hata mesajını yazdır
if(isset($error)) {
    echo '<br><div class="signup-container4"><div class="container"><div style="font-size: 20px; color: red;">' . "Invalid username or password." . '</div></div></div>';
}
    }
    
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Paneli Giriş - GameSatış</title>
    <link rel="stylesheet" type="text/css" href="style_admin.css">
</head>

<body>

    <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>

    <div class="signup-container4">

        <br>
        <h1>Admin Paneli Giriş - GameSatış</h1>
        <br>
        <?php if(isset($error)) { echo "<p>$error</p>"; } ?>
        <form method="POST" action="">
            <div class="container">
                <label>Kullanıcı Adı:</label><br>
                <input type="text" name="username"><br><br>
                <label>Şifre:</label><br>
                <input type="password" name="password"><br>
                <br> <br>
                <input type="submit" name="login" value="Giriş Yap">
            </div>
        </form>

    </div>
</body>

</html>


<style>
input[type=text],
input[type=password] {
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


h1 {
    text-align: center;
    font-size: 28px;
    margin-bottom: 20px;
}

.container {
    margin: auto;
    position: relative;
    width: 300px;
    text-align: center;
}
</style>