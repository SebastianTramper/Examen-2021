<?php 

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once "../../../config/config.php"; 
require_once "../../../includes/head.php";

if(!isset($_POST['update'])){
    $Appointment = $conn->prepare("SELECT * FROM time_blocks WHERE id = " . $_GET['id']);
    $Appointment->execute();
    $AppointmentInfo = $Appointment->fetch();



?> 

    <form action="?action=update" method="POST" class="mt-5">
        <h2>Tijdsblok aanpassen</h2>
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <label for="date">Datum</label>
        <input type="date" id="date" name="date" class="form-control" value="<?php echo explode(" ", $AppointmentInfo[1])[0]; ?>">
        <label for="start_time">Start tijd</label>
        <input type="time" id="start_time" name="start_time" class="form-control" value="<?php echo explode(" ", $AppointmentInfo[1])[1]; ?>">
        <label for="end_time">Eind tijd</label>
        <input type="time" id="end_time" class="form-control" name="end_time" value="<?php echo explode(" ", $AppointmentInfo[2])[1]; ?>">
        <div class="form-check mt-3">
            <?php if($AppointmentInfo['public'] == 1){ ?>
                <input class="form-check-input" type="radio" name="publish" value="0" id="Publiceren1">
            <?php }else{ ?>
                <input class="form-check-input" type="radio" name="publish" value="0" id="Publiceren1" checked>
            <?php } ?>
            <label class="form-check-label" for="Publiceren1">
                Offline
            </label>
            </div>
            <div class="form-check">
            <?php if($AppointmentInfo['public'] == 1){ ?>
                <input class="form-check-input" type="radio" value="1" name="publish" id="Publiceren2" checked>
            <?php }else{ ?>
                <input class="form-check-input" type="radio" value="1" name="publish" id="Publiceren2">
            <?php } ?>
            <label class="form-check-label" for="Publiceren2" >
                Online
            </label>
        </div>
        <div class="mt-4">
            <input type="submit" name="update" class="btn btn-success" value="aanmaken">
            <a href="../index.php" class="btn btn-primary" >Of ga terug</a>
        </div>

    </form>


<?php 
}

if($_GET['action'] == 'update'){

    try {

        $sql = "UPDATE time_blocks SET start_time=?, end_time=?, public=? WHERE id=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([
            $_POST['date'] . " " . $_POST['start_time'],
            $_POST['date'] . " " . $_POST['end_time'],
            $_POST['publish'],
            $_POST['id']]);

    
           header("Location: ../index.php");

    } catch (PDOException $e) {
        echo "Er gaat iets mis met het aanpassen. " . $e;
    }

    

}

require_once "../../../includes/footer.php"; 
