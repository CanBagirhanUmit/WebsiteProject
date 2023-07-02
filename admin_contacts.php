<!DOCTYPE html>
<html>

<head>
    <title>Alınan Mesajlar Admin Paneli - GameSatış</title>
    <link rel="stylesheet" type="text/css" href="style_admin.css">

    <style>
    /* Chrome, Safari ve Opera için kaydırma çubuğunu gizle */
    body::-webkit-scrollbar {
        display: none;
        -ms-overflow-style: none;
        /* IE ve Edge */
        scrollbar-width: none;
        /* Firefox */
    }

    table {
        border-collapse: collapse;
        max-width: 100%;


    }

    th,
    td {
        border-radius: 5px;
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
        max-width: 1080px;
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

    .delete-btn {
        background-color: #f44336;
    }

    .action-btn:hover {
        background-color: #333;
    }

    .scroll {
        overflow: auto;
        max-height: 200px;

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


	if (isset($_GET['delete'])) {
		$id = $_GET['delete'];
		$sql = "DELETE FROM contacts WHERE id=$id";
		mysqli_query($conn, $sql);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = $_POST["username"];
		$email = $_POST["email"];
		$password = $_POST["password"];

		$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

		if (mysqli_query($conn, $sql)) {
			echo "<p>New product added successfully.</p>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}




	$sql = "SELECT * FROM contacts";
	$result = mysqli_query($conn, $sql);


	echo "<h2>Alınan Mesajlar:</h2>";
    
	echo "<table>";
	echo "<tr>
    
    <th>Adı</th>
    <th>Email</th>
    <th>Tarih</th>
    <th>Mesaj</th>
    <th>Sil</th>
    
    </tr>";

	while ($row = mysqli_fetch_assoc($result)) {
        
		echo "<tr>

        <td><a div class='table'</td>". $row["name"] . "</td>
         <td>" . $row["email"] . "</td>
         <td>" . $row["date"] . "</td>
         <td>" . $row["message"] . "</td>
         <td><a href=\"".$_SERVER['PHP_SELF']."?delete=".$row['id']."\" class=\"action-btn delete-btn\">Sil</a></td>
         </tr>";


	}
	echo "</table>";


	mysqli_close($conn);
	?>




</body>

</html>