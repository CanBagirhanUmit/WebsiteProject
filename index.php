<!DOCTYPE html>
<html>


<head>
    <title>Ana Sayfa - GameSatış</title>
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

                <div style="width: 500px;">
                    <form action="index.php" method="GET" autocomplete="off">
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

    <section class="hero">
        <h1>Sevdiğiniz Oyunları Satın Alın</h1>
        <br> <br> <br>

        <div class="signup-containergames">
            <div class="slider">
                <div class="thumbnails-wrapper">
                    <div class="thumbnails">
                        <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webproje";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

   
    $sql = "SELECT id, name, price, img, link FROM games";
    $result = mysqli_query($conn, $sql);

    // Görüntüler ve ilişkili bilgileri için HTML kodu oluşturun
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<a href="' . $row["link"] . '"><img src="uploads/' . $row["img"] . '"></a>';
    }

    mysqli_close($conn);
?>
                    </div>
                </div>
                <button class="scroll-button left">&#8249;</button>
                <button class="scroll-button right">&#8250;</button>
            </div>

        </div>
        <script>
        let timer;



        window.onbeforeunload = function() {
            window.scrollTo(0, 0);
        }


        const thumbnails = document.querySelectorAll('.thumbnails img');
        const mainImage = document.querySelector('.main-image img');
        const leftButton = document.querySelector('.scroll-button.left');
        const rightButton = document.querySelector('.scroll-button.right');
        const thumbnailsWrapper = document.querySelector('.thumbnails-wrapper');
        const wrapperWidth = thumbnailsWrapper.scrollWidth;

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', () => {
                mainImage.src = thumbnail.src;
            });
        });

        function startTimer() {
            timer = setInterval(() => {
                const currentPosition = thumbnailsWrapper.scrollLeft;
                const maxPosition = thumbnailsWrapper.scrollWidth - thumbnailsWrapper.clientWidth;

                if (currentPosition >= maxPosition) {
                    thumbnailsWrapper.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    });
                } else if (currentPosition <= 0) {
                    thumbnailsWrapper.scrollTo({
                        left: maxPosition,
                        behavior: 'smooth'
                    });
                    setTimeout(() => {
                        thumbnailsWrapper.scrollTo({
                            left: 0,
                            behavior: 'smooth'
                        });
                    }, 3000);
                } else {
                    thumbnailsWrapper.scrollBy({
                        left: 150,
                        behavior: 'smooth'
                    });
                }

            }, 3000);
        }


        startTimer();

        thumbnailsWrapper.addEventListener('mouseover', () => {
            clearInterval(timer);
        });

        thumbnailsWrapper.addEventListener('mouseleave', () => {
            startTimer();
        });

        leftButton.addEventListener('click', () => {
            const currentPosition = thumbnailsWrapper.scrollLeft;
            const maxPosition = thumbnailsWrapper.scrollWidth - thumbnailsWrapper.clientWidth;
            if (currentPosition <= 0) {
                thumbnailsWrapper.scrollTo({
                    left: maxPosition,
                    behavior: 'smooth'
                });
                setTimeout(() => {
                    thumbnailsWrapper.scrollBy({
                        left: -150,
                        behavior: 'smooth'
                    });
                }, 3000);
            } else if (currentPosition >= maxPosition - 150) {
                thumbnailsWrapper.scrollTo({
                    left: 0,
                    behavior: 'smooth',
                });
            } else {
                thumbnailsWrapper.scrollBy({
                    left: -150,
                    behavior: 'smooth'
                });
            }

        });

        rightButton.addEventListener('click', () => {
            const currentPosition = thumbnailsWrapper.scrollLeft;
            const maxPosition = thumbnailsWrapper.scrollWidth - thumbnailsWrapper.clientWidth;
            if (currentPosition <= 0) {
                thumbnailsWrapper.scrollTo({
                    left: maxPosition,
                    behavior: 'smooth'
                });
                setTimeout(() => {
                    thumbnailsWrapper.scrollBy({
                        left: -150,
                        behavior: 'smooth'
                    });
                }, 3000);
            } else if (currentPosition >= maxPosition - 150) {
                thumbnailsWrapper.scrollTo({
                    left: 0,
                    behavior: 'smooth',
                });
            } else {
                thumbnailsWrapper.scrollBy({
                    left: -150,
                    behavior: 'smooth'
                });
            }

        });
        </script>


    </section>
    <footer>

        <p>&copy; 2023 OyunSatış</p>

    </footer>
</body>


</html>