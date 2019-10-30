<?php
$name = "";
$password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST["name"];
    $password = $_POST["password"];
    if ($name != "Jacco" && $password != "JwoW4iC") {
        $error = "Gebruikersnaam en/of wachtwoord onjuist...";
    } else {
        header("Location: admin/admin.php");
     exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KletsKoek</title>
</head>
<body>
    <h1>Kletskoek</h2>
    <form method="POST" action="">
    Gebruikersnaam: <input name = "name" type="text" value="<?= $name; ?>" > 
    <br>
    Wachtwoord: <input name = "password" type="password"> 
    <br>
    <span style = "bold; color:red"> <?= $error; ?> </span>
    <br>
    <input value="Log in" type="submit">
    </form>
</body>
</html>