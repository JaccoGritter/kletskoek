
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kletskoek</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <h2>Lijst van gebruikers</h2>
        <p><strong>U zocht op:</strong></p>

        <?php

        $username = trim( htmlspecialchars($_GET["username"]) );
        $first_name = trim( htmlspecialchars($_GET["first_name"]) );
        $last_name = trim( htmlspecialchars($_GET["last_name"]) );

        echo "<p>Username: {$username}</p>";
        echo "<p>Voornaam: {$first_name}</p>";
        echo "<p>Achternaam: {$last_name}</p>";

        // Create connection
        $conn = new mysqli("localhost", "root", "", "kletskoek");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($username == "" && $first_name == "" && $last_name == "") {
            $sql = "SELECT * FROM users";
        } else {
            $sql = "SELECT * FROM users WHERE username LIKE '$username' OR first_name LIKE '$first_name' OR last_name LIKE '$last_name' ";
        }
        //var_dump($sql);
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table class=\"table table-striped\">";
            echo "<tr>
            <th>ID</th><th>Username</th><th>Voornaam</th><th>Achternaam</th><th>Geb.datum</th><th></th>
            </tr>";
            // output data of each row
            while ($row = $result->fetch_assoc()) {

                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['birth_date'] . "</td>";
                echo "<td><a href = \"edituser.php?id={$row['id']}\" class=\"btn btn-info\" role=\"button\">Edit</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<b>0 resultaten</b><br><br>";
        }
        $conn->close();
        ?>
        <a href="finduser.php" class="btn btn-info" role="button">Nieuwe zoekopdracht</a>
        <a href="admin.php" class="btn btn-info" role="button">Terug naar admin pagina</a>
    </div>
</body>