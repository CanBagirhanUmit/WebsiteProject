<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel - Games</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    h2 {
        margin-top: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        margin-bottom: 30px;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .action-btn {
        padding: 5px 10px;
        text-decoration: none;
        background-color: #3498db;
        color: #fff;
        border-radius: 3px;
        font-size: 14px;
    }

    .edit-btn {
        background-color: #2ecc71;
        margin-right: 5px;
    }

    .delete-btn {
        background-color: #e74c3c;
    }

    .add-image-btn {
        background-color: #f1c40f;
    }

    form {
        margin-top: 30px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"] {
        padding: 10px;
        border-radius: 3px;
        border: 1px solid #ccc;
        width: 100%;
        margin-bottom: 20px;
    }

    input[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        font-size: 16px;
    }
    </style>
</head>

<body>
    <?php

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "webproje";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

       
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $img = $_POST["img"];
    
            $sql = "INSERT INTO games (img) VALUES ('$img')";
    
            if (mysqli_query($conn, $sql)) {
                echo "<p>New game added successfully.</p>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
            
    
      
        $sql = "SELECT * FROM games";
        $result = mysqli_query($conn, $sql);
    
        ?>

    <h2>Add Images:</h2>
    <form method="post" action="admin_gamesaddimage.php" enctype="multipart/form-data">
        <label for="id">Game ID:</label>
        <input type="number" name="id" required>
        <label for="image">Image:</label>
        <input type="file" name="image" required>
        <input type="submit" value="Add Image">
    </form>

</body>

</html>