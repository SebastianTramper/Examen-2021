
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

<div class="mt-4">
U kunt uw bewijs overnieuw donwloaden.
</div>

<form action="" method="POST" class="mt-3">
    <input type="submit" name="download" class="btn btn-success" style="cursor:pointer" value="Downloaden opnieuw">
</form>

<?php if(isset($_POST['download'])){

$data = '';
$data .= '<h1>Toegangsbewijs Schaatsbaan de Klapschaats</h1>';
$data .= '<p>Bedankt voor het aanmelden! Laat dit document zien bij de schaatsbaan.</p>';
$data .= '<p>Veel schaats plezier</p>';
$data .= '<p>Naam: <strong> '.  $name  .' </strong></p>';
$data .= '<p>Adres: <strong> '. $adress .' </strong></p>';
$data .= '<p>Plaats: <strong> '.  $town  .' </strong></p>';

if($member == 1){
    $data .= '<p>U bent <strong>lid</strong> en daarom hoeft u niet extra te betalen</p>';    
}
if($member == 0){
    $data .= '<p>U bent <strong>geen lid</strong>, bij de ingang van de schaatsbaan kunt u betalen.</p>';    
}

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);
$mpdf->Output('Toegangsbewijs.pdf', 'D');


} ?>
<?php } ?>


<?php require_once "./includes/footer.php"; ?>


