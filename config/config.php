
<?php

session_start();

$DSN = "mysql:host=localhost;dbname=examen_2021";
$databaseUsername = "examen2021";
$databasePassword = "6liutJdp";

try {
    $conn = new PDO($DSN, $databaseUsername, $databasePassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOExeption $e) {
    echo "No connection can be made with the database. Error message: " . $e->getMessage();
}

