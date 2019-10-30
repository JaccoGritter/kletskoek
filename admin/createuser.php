<?php
require '..\classes\user.php';

$message = "";

$username = "";
$first_name = "";
$last_name = "";
$birth_date = "";
$member_since = "";


if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
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
    $stmt = $conn->prepare("INSERT INTO users (username, first_name, last_name) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $first_name, $last_name);

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    //echo "New records created successfully";
    $stmt->close();

    $sql = "UPDATE users SET birth_date= \"{$birth_date}\", member_since = \"{$member_since}\" WHERE username = \"{$username}\"";
    if ($conn->query($sql) === TRUE) {
        echo "User created succesfully";
        } else {
            echo "Error creating user table: " . $conn->error;
        }

    $conn->close();
}

?>

<h1>Create User</h1>
<br>
<form action = "" method = "POST">
Username:<input type = "text" name = "username" value = "<?= $username ?>" required>
<br>
Voornaam:<input type = "text" name = "first_name" value = "<?= $first_name ?>">
<br>
Achternaam:<input type = "text" name = "last_name" value = "<?= $last_name ?>">
<br>
Geboortedatum:<input type = "date" name = "birth_date" value = "<?= $birth_date ?>">
<br>
<?= $message ?>
<input type="submit" value = "Verstuur">
</form>