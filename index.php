<?php require_once "./includes/head.php"; ?>
<?php require_once "./config/config.php"; ?>
<?php

//if(isset($_SESSION['username'])){
//    if ($_SESSION['userRole'] == 1) {
//        header("Location: dashboard/default.php");
//    }
//
//    if ($_SESSION['userRole'] == 2) {
//        header("Location: dashboard/admin.php");
//    }
//}


?>

<?php if (!isset($_POST['NewAccount'])) { ?>

    <!-- Login -->
    <form action="login.php" method="POST" class="needs-validation" novalidate>
        <h1>Login met jou account</h1>
        <div class="mb-3">
            <input type="text" class="form-control" name="username" placeholder="Gebruikersnaam" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Wachtwoord" required>
        </div>

        <input type="submit" class="btn btn-primary" value="Login" name="submit">
    </form>

    <form action="#" method="POST">
        <input type="submit" name="NewAccount" class="bg-white border-0 text-primary py-4" style="cursor:pointer" value="Of maak een account aan.">
    </form>

<?php } ?>

<?php if (isset($_POST['NewAccount']) && !isset($_POST['ExistingAccount'])) { ?>

    <!-- Register -->
    <form action="register.php" method="POST" class="needs-validation" novalidate>
        <h1>Maak een nieuw account aan</h1>
        <div class="mb-3">
            <input type="text" name="username" placeholder="Gebruikersnaam" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" name="email" placeholder="E-mailadres" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" name="phone" placeholder="Telefoonnummer" class="form-control" required>
        </div>
        <div>
            <input type="password" name="password" placeholder="Wachtwoord"  class="form-control" required><br>
        </div>
        <div class="mb-3">
            <input type="password" name="passwordVerify" placeholder="Verifieer Wachtwoord" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" name="name" placeholder="Naam" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" name="adress" placeholder="Adres" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" name="town" placeholder="Plaats" class="form-control" required>
        </div>
        <input type="submit" value="Registeer" name="submit" class="btn btn-primary"><br>
    </form>

    <form action="#" method="POST">
        <input type="submit" name="ExistingAccount" class="bg-white border-0 text-primary py-4" style="cursor:pointer" value="Of heb je al een account">
    </form>

<?php }?>
    </section>

<?php require_once "./includes/footer.php"; ?>