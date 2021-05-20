<?php 

require_once "../config/config.php"; 

if (isset($_POST['signout'])) {

    $stmt = $conn->prepare( "DELETE FROM Appointment WHERE id = :appointment");
    $stmt->bindParam(':appointment', $_POST['time_block_id']);
    $stmt->execute();

    header("Location: default.php");
}
