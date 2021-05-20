
<?php 

require_once "../config/config.php"; 
require_once "../includes/head.php";

if(isset($_SESSION['Username'])){
    header("Location: ../index.php");
}

?>




<div class="mb-5">
    <h2>Er is iets verkeerd gegaan met het inloggen. </h2>
    <a href="/">Probeer het opnieuw</a>
</div>




<?php require_once "../includes/footer.php"; ?>
