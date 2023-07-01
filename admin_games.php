<!DOCTYPE html>
<html>

<head>
    <title>Satılan Oyunlar Admin Paneli - GameSatış</title>
    <link rel="stylesheet" type="text/css" href="style_admin.css">
    <style>
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
            $sql = "DELETE FROM games WHERE id=$id";
            mysqli_query($conn, $sql);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $price = $_POST["price"];
            $link = $_POST["link"];
            $quantity = $_POST["quantity"];
            $img = $_FILES["img"]["name"];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

            $sql = "INSERT INTO games (name, price, link, quantity, img) VALUES ('$name' , '$price', '$link', '$quantity', '$img')";

            if (mysqli_query($conn, $sql)) {
                echo "<p>New game added successfully.</p>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }



   
        $sql = "SELECT * FROM games";
        $result = mysqli_query($conn, $sql);


        echo "<h2>Satılan Oyunlar:</h2>";
        echo "</div>";
        echo "<table>   
        <thead>
        <tr>
            <th>ID</th>
            <th>Oyun İsmi</th>
            <th>Ücret</th>
            <th>Link</th>
            <th>Adet</th>
            <th>Oyunun Resmi</th>
            <th>Düzenle</th>
            <th>Sil</th>
        </tr>
        </thead>
        <tbody>";

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["link"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td><img src='uploads/" . $row["img"] . "' width='100'></td>";
                echo "<td><a class='action-btn edit-btn' href='admin_gamesedit.php?id=". $row["id"] ."'>Düzenle</a></td>";
                echo "<td><a class='action-btn delete-btn' href='?delete=". $row["id"] ."' onclick='return confirm(\"Are you sure you want to delete this game?\")'>Sil</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No games found</td></tr>";
        }

        echo "</tbody>
        </table>";

      
        mysqli_close($conn);
    ?>
        <br> <br> <br>
        <div class="signup-container4">
            <div class="container">
                <h2>Yeni Oyun Ekle:</h2>
                <form method="post" enctype="multipart/form-data">
                    <label for="name">Oyun Adı:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="price">Ücret</label>
                    <input type="number" id="price" name="price" required>

                    <label for="link">Link:</label>
                    <input type="text" id="link" name="link" required>

                    <label for="quantity">Adet:</label>
                    <input type="number" id="quantity" name="quantity" required>
                    <br> <br> <br>
                    <label for="img">Oyunun Resmi:</label>
                    <br> <br> <br>
                    <input type="file" id="img" name="img" accept="image/*" required>
                    <br> <br> <br>
                    <input type="submit" value="Oyun Ekle">
                </form>
            </div>
        </div>
</body>

</html>