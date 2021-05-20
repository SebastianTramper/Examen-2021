
<?php require_once "../config/config.php"; 
require_once "../includes/head.php";
require_once '../vendor/autoload.php';

$name = $_SESSION["name"];
$adress = $_SESSION["adress"];
$town = $_SESSION["town"];
$member = $_SESSION['member'];
?>


<h1>Bedankt voor het aanmelden!</h1>
<p>Print uw aanmeld bewijs uit door op downloaden te klikken.</p>
<a href="../index.php" class="btn btn-primary">Terug naar het overzicht</a>

<form action="" method="POST" class="mt-3">
    <input type="submit" name="download" class="btn btn-success" style="cursor:pointer" value="Downloaden">
</form>

<?php

if(isset($_POST['download'])){
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
}


require_once "./includes/footer.php"; 


