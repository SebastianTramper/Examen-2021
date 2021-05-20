<?php 

require_once "../../../config/config.php"; 

if (isset($_POST['delete'])) {
    $stmt = $conn->prepare( "DELETE FROM time_blocks WHERE id =:appointment" );
    $stmt->bindParam(':appointment', $_GET['appointment']);
    $stmt->execute();

    header("Location: ../index.php");

}
