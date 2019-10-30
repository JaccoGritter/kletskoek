<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if database exists
$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'KletsKoek';";
$result = $conn->query($sql);
if ($result -> num_rows > 0) {
    echo "Database bestaat al!";
} else {
    echo "Database bestaat nog niet.<br>";
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS KletsKoek;";
    if ($conn->query($sql) === TRUE) {
        echo "Database KletsKoek created successfully <br>";
        // Create user table
        $conn = new mysqli($servername, $username, $password, "KletsKoek");
        $sql = "CREATE TABLE users (
            id int NOT NULL AUTO_INCREMENT,
            username varchar(255) NOT NULL,
            first_name varchar(255),
            last_name varchar(255),
            birth_date date,
            member_since date,
            PRIMARY KEY (id),
            UNIQUE (username)
        );";
        if ($conn->query($sql) === TRUE) {
        echo "User table created succesfully";
        } else {
            echo "Error creating user table: " . $conn->error;
        }
    } else {
        echo "Error creating database: " . $conn->error;
    }
}


$conn->close();
?>

<br>
<a href="admin.php">Terug naar admin index</a>