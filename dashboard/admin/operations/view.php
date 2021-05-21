<?php 

require_once "../../../config/config.php";

if($_SESSION['UserRole'] == 2){

require_once "../../../includes/head.php"; 

$Appointment = $conn->prepare("SELECT * FROM Appointment WHERE block_id = " . $_GET['id']);
$Appointment->execute();
$AppointmentInfo = $Appointment->fetchAll();

?>


<table class="table">

    <thead>
    <tr>
        <th scope="col">Naam:</th>
        <th scope="col">Adres:</th>
        <th scope="col">Plaats:</th>
        <th scope="col">Phone:</th>
        <th scope="col">E-mailadres:</th>
    </tr>
    </thead>
    <tbody>
    
        <?php 
       
       if(empty($AppointmentInfo)){?>
            <tr>
                <td>Er zijn nog geen inschrijvingen</td>
            </tr>
        <?php }

        foreach($AppointmentInfo as $Appointment){ 

            $participatingPeople = $conn->prepare("SELECT * FROM users WHERE id = " . $Appointment['user_id']);
            $participatingPeople->execute();
            $participatingPeopleList = $participatingPeople->fetchAll();
            
            foreach($participatingPeopleList as $People){ ?>
                <tr>
                <td>
                    <?php echo $People['name']; ?>
                </td>
                <td>
                    <?php echo $People['adress']; ?>
                </td>
                <td>
                    <?php echo $People['plaats']; ?>
                </td>
                <td>
                    <?php echo $People['phone']; ?>
                </td>
                <td>
                    <?php echo $People['email']; ?>
                </td>
                </tr>
                
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

<a href="../index.php" class="btn btn-primary">Terug naar het overzicht</a>

<?php 
require_once "../../../includes/footer.php"; 
} else{
    header("Location: ../../../index.php");
}