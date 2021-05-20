
<?php require_once "../../config/config.php"; 

if($_SESSION['UserRole'] == 2){
    
require_once "../../includes/head.php"; 
?>

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
        <th scope="col">Gepublisheerd</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($rowList as $row){ 
        
        $appointments = $conn->prepare("SELECT * FROM Appointment WHERE block_id = " . $row['id']);
        $appointments->execute();
        $maxAppointments = $appointments->fetchAll();
        
        ?>
        <tr>
            <td><?php echo date("d/m/Y", strtotime(explode(" ",$row['start_time'])[0]));?></td>
            <td class="d-flex align-content-center h-100"><?php echo explode(" ",$row['start_time'])[1] . " t/m ". explode(" ",$row['end_time'])[1]; ?></td>
            <td>
                <?php if($row['public'] == 0){ echo "Offline"; }  ?>
                <?php if($row['public'] == 1){ echo "Online"; }  ?>
            </td>
            <td>
                <a href="./operations/view.php?id=<?= $row['id'] ?>" class="btn btn-primary">Bekijk inschrijvingen</a>
            </td>
            <td>
                <a href="./operations/update.php?id=<?= $row['id'] ?>" class="btn btn-success">Tijdsblok aanpassen</a>
            </td>
            <td>
   
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']?>">
                    Verwijderen
                </button>

                <div class="modal fade" id="deleteModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tijdsblok verwijderen</h5>
                            <button type="button" class="bg-white border-0" data-bs-dismiss="modal" aria-label="Close">x</button>
                        </div>
                        <div class="modal-body">
                            <p>Weet u zeker dat dit tijdblok verwijder moet worden?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="./operations/delete.php?appointment=<?php echo $row['id']?>" method="POST" class="mb-0">
                                <input type="submit" name="delete" class="btn btn-danger" value="Verwijderen">
                            </form>
                            <a href="." class="btn btn-success">Een stap terug</a>
                        </div>
                        </div>
                    </div>
                </div>
                
            </td>
      
        </tr>
    <?php } ?>
    </tbody>
</table>





<?php if(!empty($_SESSION['Username'])){ ?>
        <form action="./operations/create.php" method="POST">
            <input type="submit" name="new" class="btn btn-success" value="Nieuw tijdsblok invoegen">
        </form>
<?php } ?>

<?php } 



?>


</div>


<?php require_once "../../includes/footer.php";

}else{
    header("Location: ../../index.php");
}
?>
