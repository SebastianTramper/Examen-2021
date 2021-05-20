
<?php require_once "../config/config.php"; ?>
<?php require_once "../includes/head.php"; ?>

<?php

$listResult = $conn->prepare("SELECT * FROM time_blocks");
$listResult->execute();
$rowList = $listResult->fetchAll();

?>

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
        if($row['public'] == 1){
            $appointments = $conn->prepare("SELECT * FROM Appointment WHERE block_id = " . $row['id']);
            $appointments->execute();
            $maxAppointments = $appointments->fetchAll();?>
            <tr>
                <td><?php echo explode(" ",$row['start_time'])[0]?></td>
                <td class="d-flex align-content-center h-100"><?php echo explode(" ",$row['start_time'])[1] . " t/m ". explode(" ",$row['end_time'])[1]; ?></td>
                <td>
                    <?php if(count($maxAppointments) <= 100){ ?>
                        <?php if(!empty($_SESSION['Username'])){ ?>
                            <form action="?appointment=<?php echo $row['id']?>" method="POST">
                                <input type="submit" name="time" class="btn btn-primary" value="Aanmelden">
                            </form>
                        <?php } ?>
                        <?php if(empty($_SESSION['Username'])){ ?>
                            <form action="/" method="POST">
                                <input type="submit" name="login" class="btn btn-primary" style="cursor:pointer" value="Aanmelden">
                            </form>
                        <?php } ?>
                    <?php }?>

                    <?php if(count($maxAppointments) > 100){ ?>
                        <p class="text-danger">Dit tijdslot is vol!</p>
                    <?php } ?>
                </td>
            </tr>
            <?php }  ?>
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
        <h3>Reservering bevestigen</h3>
        <p>Dit is een reservering voor:  <?php echo explode(" ",$currentAppointmentResult['start_time'])[0]; ?> 
        <br> Vanaf <?php echo explode(" ",$currentAppointmentResult['start_time'])[1] . " tot ". explode(" ",$currentAppointmentResult['end_time'])[1]; ?> </p>
        <input type="submit" class="btn btn-primary" value="Aanmelden" name="signup">
        <a href="./default.php" class="btn btn-primary">Terug naar het overzicht</a>
    </form>

<?php } ?>

</div>


<?php require_once "../includes/footer.php"; ?>
