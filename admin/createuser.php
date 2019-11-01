<?php
//require '..\classes\user.php';

$general_message = "";
$error_message = "";

$username = "";
$password = "";
$first_name = "";
$last_name = "";
$birth_date = "";
$member_since = "";
$success = FALSE;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim( htmlspecialchars($_POST["username"]) );
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $first_name = trim( htmlspecialchars($_POST["first_name"]) );
    $last_name = trim( htmlspecialchars($_POST["last_name"]) );
    $birth_date = $_POST["birth_date"];
    $member_since = date("Y/m/d");

    // DIT MOET IN EEN APARTE FILE/FUNCTIE
    // Create connection
    $conn = new mysqli("localhost", "root", "", "KletsKoek");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $first_name, $last_name);

    if (!$stmt->execute()) {
        if ($stmt->errno === 1062) {
            $error_message = "Username {$username} bestaat al!\n";
        } else {
            $error_message = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    } else {
        $success = TRUE;
    }

    $stmt->close();

    if ($success === TRUE) {
        $sql = "UPDATE users SET birth_date= '{$birth_date}', member_since = '{$member_since}' WHERE username = '{$username}'";
        if ($conn->query($sql) === TRUE) {
            $general_message =  "User {$username} succesvol aangemaakt\n";
            $username = "";
            $first_name = "";
            $last_name = "";
            $birth_date = "";
            $member_since = "";
        } else {
            echo "Error creating user table: " . $conn->error;
        }
        $success = FALSE;
        $conn->close();
    }
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
        <h1>Voeg gebruiker toe</h1>
        <h5>Maak een nieuwe gebruiker aan</h5>
        <br>
        <form action="" method="POST">
            <div class="form-group">
                Username: <input type="text" class="form-control" name="username" value="<?= $username ?>" required>
            </div>
            <div class="form-group">
                Wachtwoord: <input type="password" class="form-control" name="password" required>
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
            <input class="btn btn-primary" type="submit" value="Verstuur">

        </form>
        <br>
        <a href="admin.php" class="btn btn-info" role="button">Terug naar admin pagina</a>
    </div>
</body>

</html>