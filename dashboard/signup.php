
<?php require_once "../config/config.php"; ?>
<?php require_once "../includes/head.php";  ?>

<?php

$Appointments = $conn->prepare("SELECT * FROM Appointment WHERE user_id = ? AND block_id = ?");
$Appointments->execute([$_SESSION['ID'],$_POST['appointmentId']]);
$AppointmentsLimit = $Appointments->fetch();


if(empty($AppointmentsLimit)){
    try {
        $stmt = $conn->prepare("INSERT INTO  Appointment(ID, user_id, block_id)
        VALUES (?, ?, ?)");
        $stmt->execute([
                null,
            $_SESSION['ID'],
            $_POST['appointmentId'],
           ]);
    
            header("Location: success.php");
    
    } catch (PDOException $e) {
        echo "Er gaat iets mis met het aanmelden " . $e;
    }
    
}else{ ?>

<h4 class="text-danger">Uw hebt zich al aangemeld voor dit tijdsblok</h4>
<a href="default.php" class="btn btn-primary">Ga terug naar het overzicht</a>

<?php } ?>


<?php require_once "./includes/footer.php"; ?>


