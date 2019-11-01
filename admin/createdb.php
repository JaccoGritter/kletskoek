<?php

require 'checkifdbexists.php';



// function kletskoekExists() {
//     global $servername, $username, $password;
//     // Create connection
//     $conn = new mysqli($servername, $username, $password);
//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     // Check if database exists
//     $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'kletskoek';";
//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         return TRUE;
//     } else {
//         return FALSE;
//     }
//     $conn->close();
// }


function createKletskoek() {

    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS kletskoek;";
    if ($conn->query($sql) === TRUE) {
        echo "Database kletskoek created successfully\n";
        // Create user table
        $conn = new mysqli($servername, $username, $password, "kletskoek");
        $sql = "CREATE TABLE users (
            id int NOT NULL AUTO_INCREMENT,
            username varchar(255) NOT NULL,
            password varchar(255) NOT NULL,
            first_name varchar(255),
            last_name varchar(255),
            birth_date date,
            member_since date,
            PRIMARY KEY (id),
            UNIQUE (username)
        );";
        if ($conn->query($sql) === TRUE) {
            echo "User table created succesfully\n";
        } else {
            echo "Error creating user table: " . $conn->error;
        }
    } else {
        echo "Error creating database: " . $conn->error;
    }
    $conn->close();
}

if (kletskoekExists()) {
    echo "Database bestaat al!!";
} else {
    createKletskoek();
}
