<?php  require_once "./includes/head.php"; ?>
<?php require_once "./config/config.php"; ?>

<?php

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$checkExistingUsername = $conn->prepare("SELECT * FROM users WHERE username = ?");
$checkExistingUsername->execute([$_POST['username']]);


if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

    if($_POST['password'] == $_POST['passwordVerify']){

        if(!$checkExistingUsername->rowCount() > 0){

            try {
                $stmt = $conn->prepare("INSERT INTO  users(ID, username, password, email, name, adress, plaats, phone, role)
                VALUES (?, ?, ?, ?, ?,? ,? ,?, ?)");
                $stmt->execute([
                        null,
                    $_POST['username'],
                    $password,
                    $_POST['email'],
                    $_POST['name'],
                    $_POST['adress'],
                    $_POST['town'],
                    $_POST['phone'], 1]);

                include "./login.php";

            } catch (PDOException $e) {
                echo "Er gaat iets mis met het registeren. " . $e;
            }

        }
    }


} ?>


<?php
//  validate Email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { ?>

    <p>Het ingevoerde emailadres: <?php  $_POST['email'] ?>  is niet geldig.<br>
    <form action="index.php" method="POST">
        <input type="submit" name="NewAccount" class="bg-white border-0 text-primary py-4" style="cursor:pointer" value="Probeer het nog eens">
    </form>

<?php } ?>



<?php
// validate username duplicate
if($checkExistingUsername->rowCount() > 0){ ?>

    <p>Gebruikersnaam: <?php $_POST['username'] ?> is niet meer beschikbaar. Probeer een andere. <br></p>
    <form action="index.php" method="POST">
        <input type="submit" name="NewAccount" class="bg-white border-0 text-primary py-4" style="cursor:pointer" value="Probeer het nog eens">
    </form>

<?php } ?>

<?php
// validate password verify
if($_POST['password'] != $_POST['passwordVerify']){ ?>

    <p>De ingevulde wachtwoorden zijn niet gelijk </p>
    <form action="index.php" method="POST">
        <input type="submit" name="NewAccount" class="bg-white border-0 text-primary py-4" style="cursor:pointer" value="Probeer het nog eens">
    </form>

<?php } ?>


<?php require_once "./includes/footer.php"; ?>
