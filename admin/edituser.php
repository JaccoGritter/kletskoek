<?php

$id = $_GET["id"];
$general_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // Create connection
    $conn = new mysqli("localhost", "root", "", "kletskoek");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE id=" . $id;

    //var_dump($sql);
    $result = $conn->query($sql);
    //var_dump($result);
    $user = $result->fetch_assoc();
    $username = $user["username"];
    $first_name = $user["first_name"];
    $last_name = $user["last_name"];
    $birth_date = $user["birth_date"];
    
    $conn->close();

} else {
    // formulier is gepost
    $id = $_POST["id"];
    $username = trim( htmlspecialchars($_POST["username"]) );
    $first_name = trim( htmlspecialchars($_POST["first_name"]) );
    $last_name = trim( htmlspecialchars($_POST["last_name"]) );
    $birth_date = trim( htmlspecialchars($_POST["birth_date"]) );
    $general_message = "formulier is gepost";

    // Create connection
    $conn = new mysqli("localhost", "root", "", "kletskoek");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET first_name='{$first_name}', last_name='{$last_name}', birth_date='{$birth_date}' WHERE id=" . $id;
    
    if ($conn->query($sql) === TRUE) {
        $general_message =  "User {$username} succesvol gewijzigd\n";
        // $username = "";
        // $first_name = "";
        // $last_name = "";
        // $birth_date = "";
        // $member_since = "";
    } else {
        $error_message = "Error creating user table: " . $conn->error;
    }

    $conn->close();

}
?>

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
        <h3>Edit user <?= $username ?> </h3>
        <form action="" method="POST">
            <div class="form-group">
                ID: <input type="text" class="form-control" name="id" value="<?= $id ?>" readonly>
            </div>
            <div class="form-group">
                Username: <input type="text" class="form-control" name="username" value="<?= $username ?>" readonly>
            </div>
            <div class="form-group">
                Voornaam:<input type="text" class="form-control" name="first_name" value="<?= $first_name ?>">
            </div>
            <div class="form-group">
                Achternaam:<input type="text" class="form-control" name="last_name" value="<?= $last_name ?>">
            </div>
            <div class="form-group">
                Geboortedatum:<input type="date" class="form-control" name="birth_date" value="<?= $birth_date ?>">
            </div>
            <p style="color: red"> <?= $error_message ?> </p>
            <p style="color: green"> <?= $general_message ?> </p>
            <input class="btn btn-primary" type="submit" value="Wijzig">

        </form>
        <br>
        <a href="admin.php" class="btn btn-info" role="button">Terug naar admin pagina</a>

    </div>
</body>
</html>