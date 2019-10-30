<!-- <?php

        echo $_GET["username"] . "\n";
        echo $_GET["first_name"] . "\n";
        echo $_GET["last_name"] . "\n";

        ?> -->

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
        <p>Username: <?= $_GET["username"] ?></p>
        <p>Voornaam: <?= $_GET["first_name"] ?></p>
        <p>Achternaam: <?= $_GET["last_name"] ?></p>

        <?php

        // Create connection
        $conn = new mysqli("localhost", "root", "", "kletskoek");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    $sql = "SELECT * FROM users WHERE username LIKE '" . $_GET["username"] . "'";
    
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table class=\"table table-striped\">";

            // output data of each row
            while ($row = $result->fetch_assoc()) {
                
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['birth_date'] . "</td>";
                echo "</tr>";
                
            }
            echo "</table>";
        } else {
            echo "0 resultaten";
        }
        $conn->close();
        ?>

    </div>
</body>