
<?php require_once "../config/config.php"; ?>
<?php require_once "../includes/head.php";
require_once '../vendor/autoload.php';

?>

<?php

if($_SESSION['ID'] == $_GET['id']){

    $stmt = $conn->prepare("SELECT * FROM Appointment WHERE user_id = ?");
    $stmt->execute([$_GET['id']]);
    $appointment = $stmt->fetch();

    $stmt = $conn->prepare("SELECT * FROM time_blocks WHERE id = ?");
    $stmt->execute([$appointment["block_id"]]);
    $timeBlocks = $stmt->fetch();

    if($timeBlocks){

        $day = date("d/m/Y", strtotime(explode(" ",$timeBlocks[1])[0]));
        $start_date = explode(" ",$timeBlocks[2])[1];
        $end_date = explode(" ",$timeBlocks[1])[1];
        
        
        $name = $_SESSION["name"];
        $adress = $_SESSION["adress"];
        $town = $_SESSION["town"];
        $member = $_SESSION['member'];
        
        
        ?>
        
        
        <h1>Uw resevering</h1>
            <p>Datum: <?= $day; ?></P>
            <p>Start tijd: <?= $start_date; ?></P>
            <p>eind tijd: <?= $end_date; ?></p>
    
        <p>Print uw aanmeld bewijs uit door op downloaden te klikken.</p>
        <form action="" method="POST" class="mt-3">
            <input type="submit" name="download" class="btn btn-success" style="cursor:pointer" value="Downloaden">
        </form>
       
       <div>
           <a href="default.php" class="btn btn-primary">Terug naar het reserverings overzicht</a>
       </div>
        
        <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
            Uitschrijven
        </button>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Uitschrijven</h5>
                    <button type="button" class="bg-white border-0" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <p>Weet u zeker dat u wilt uitschrijven?</p>
                </div>
                <div class="modal-footer">
                <form action="signout.php" method="POST" class="mb-0">
                    <input type="hidden" value="<?= $appointment['id'] ?>" name="time_block_id">
                    <input type="submit" name="signout" class="btn btn-danger" style="cursor:pointer" value="Uitschrijven">
                </form>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Een stap terug</button>
                </div>
                </div>
            </div>
        </div>
        
        <?php
        
        if(isset($_POST['download'])){
            $data = '';
            $data .= '<h1>Toegangsbewijs Schaatsbaan de Klapschaats</h1>';
            $data .= '<p>Bedankt voor het aanmelden! Laat dit document zien bij de schaatsbaan.</p>';
            $data .= '<p>Veel schaats plezier</p>';
            $data .= '<p>Naam: <strong> '.  $name  .' </strong></p>';
            $data .= '<p>Adres: <strong> '. $adress .' </strong></p>';
            $data .= '<p>Plaats: <strong> '.  $town  .' </strong></p>';
            $data .= '<p>Datum: <strong> '.  $day  .' </strong></p>';
            $data .= '<p>Vanaf: <strong> '.  $end_date  .' Tot ' .  $start_date . '</p>';
        
            if($member == 1){
            $data .= '<p>U bent <strong>lid</strong> en daarom hoeft u niet extra te betalen</p>';    
            }
            if($member == 0){
            $data .= '<p>U bent <strong>geen lid</strong>, bij de ingang van de schaatsbaan kunt u betalen.</p>';    
            }
        
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($data);
            $mpdf->Output('Toegangsbewijs.pdf', 'D');
        }
    }else{ ?>
    <p>U heeft nog geen reserving gemaakt!</p>
    <a href="default.php" class="btn btn-primary">Maak een reservering</a>
<?php }?>
    



</div>


<?php 

}else{
    header("Location: ../index.php");
}

require_once "../includes/footer.php"; ?>
