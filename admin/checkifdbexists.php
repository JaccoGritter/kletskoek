<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbexists = FALSE; 

function kletskoekExists() {

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
    $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'kletskoek';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $dbexists = TRUE;
    } else {
        $dbexists = FALSE;
    }
    $conn->close();
    return $dbexists;
}

?>