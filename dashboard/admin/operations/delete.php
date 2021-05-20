<?php 

require_once "../../../config/config.php"; 

if($_SESSION['UserRole'] == 2){

if (isset($_POST['delete'])) {
    $stmt = $conn->prepare( "DELETE FROM time_blocks WHERE id =:appointment" );
    $stmt->bindParam(':appointment', $_GET['appointment']);
    $stmt->execute();

    header("Location: ../index.php");

}
}else{
    header("Location: ../../../index.php");
}