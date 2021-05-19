
<?php require_once "../includes/head.php"; ?>
<?php require_once "../config/config.php"; ?>

<?php

$listResult = $conn->prepare("SELECT * FROM time_blocks");
$listResult->execute();
$rowList = $listResult->fetchAll();



?>

<div class="mb-5">
    <h2>Welkom <?php echo $_SESSION['Username'] ?> </h2>
</div>

<?php if (!isset($_POST['time'])) {  ?>

<h3>Schaatsbaan overzicht</h3>
<table class="table">

    <thead>
    <tr>
        <th scope="col">Datum:</th>
        <th scope="col">tijd:</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($rowList as $row){ 
        
        $appointments = $conn->prepare("SELECT * FROM Appointment WHERE block_id = " . $row['id']);
        $appointments->execute();
        $maxAppointments = $appointments->fetchAll();
        
        var_dump($maxAppointments);
        ?>

        <tr>
            <td><?php echo explode(" ",$row['start_time'])[0]?></td>
            <td class="d-flex align-content-center h-100"><?php echo explode(" ",$row['start_time'])[1] . " t/m ". explode(" ",$row['end_time'])[1]; ?></td>
            <td>


                <form action="?appointment=<?php echo $row['id']?>" method="POST">
                    <input type="submit" name="time" class="btn btn-primary" value="Aanmelden">
                </form>
            </td>
<!--            <td><a href="" class="text-danger">Verwijderen</a></td>-->

        </tr>

    <?php } ?>

    </tbody>
</table>
<?php }

if (isset($_POST['time'])) {

    $currentAppointment = $conn->prepare("SELECT * FROM time_blocks WHERE id = " . $_GET['appointment']);
    $currentAppointment->execute();
    $currentAppointmentResult = $currentAppointment->fetch();
    
}


if (isset($_POST['time'])) {  ?>
    <!-- aanmelden -->
    <form action="signup.php" method="POST" class="needs-validation" novalidate>
    <input type="hidden" name="appointmentId" value="<?php echo $currentAppointmentResult['id'] ?>" required>
        <h3>Reserveren schaatsbaan</h3>
        <p>Dit is een reservering voor:  <?php echo explode(" ",$currentAppointmentResult['start_time'])[0]; ?> 
        <br> Vanaf <?php echo explode(" ",$currentAppointmentResult['start_time'])[1] . " tot ". explode(" ",$currentAppointmentResult['end_time'])[1]; ?> </p>
        <input type="submit" class="btn btn-primary" value="Aanmelden" name="signup">
        <a href="./default.php" class="btn btn-primary">Terug naar het overzicht</a>
    </form>

<?php } ?>

</div>


<?php require_once "../includes/footer.php"; ?>
