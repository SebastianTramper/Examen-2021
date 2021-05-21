<?php require_once "./config/config.php"; ?>
<?php  require_once "./includes/head.php"; ?>


<?php
if(empty($_POST['honeypod'])){
    
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $checkExistingUsername = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkExistingUsername->execute([$_POST['username']]);
    
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    
        if($_POST['password'] == $_POST['passwordVerify']){
    
            if(!$checkExistingUsername->rowCount() > 0){
    
                try {
                    $stmt = $conn->prepare("INSERT INTO  users(ID, username, password, email, name, adress, plaats, phone, member, role)
                    VALUES (?, ?, ?, ?, ?,? ,? ,?, ?, ?)");
                    $stmt->execute([
                            null,
                        $_POST['username'],
                        $password,
                        $_POST['email'],
                        $_POST['name'],
                        $_POST['adress'],
                        $_POST['town'],
                        $_POST['phone'],
                        $_POST['member'],
                        1]);
    
                    include "./login.php";
    
                } catch (PDOException $e) {
                    echo "Er gaat iets mis met het registeren. " . $e;
                }
    
            }
        }
    
    
    } 
}else{
    echo "Bots zijn niet welkom";
}
?>


<?php
//  validate Email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { ?>

    <p class="text-danger">Het ingevoerde emailadres: <?php  $_POST['email'] ?>  is niet geldig.<br>
    <form action="index.php" method="POST">
        <input type="submit" name="NewAccount" class="btn btn-primary" style="cursor:pointer" value="Probeer het nog eens">
    </form>

<!--  validate username duplicate -->
<?php } else if ($checkExistingUsername->rowCount() > 0){ ?>

    <p class="text-danger">De invoerde Gebruikersnaam <?php $_POST['username'] ?> is niet meer beschikbaar. Probeer een andere. <br></p>
    <form action="index.php" method="POST">
        <input type="submit" name="NewAccount" class="btn btn-primary" style="cursor:pointer" value="Probeer het nog eens">
    </form>

<!-- validate two passwords -->
<?php } else if($_POST['password'] != $_POST['passwordVerify']){ ?>
    <p class="text-danger">De ingevulde wachtwoorden zijn niet gelijk </p>
    <form action="index.php" method="POST">
        <input type="submit" name="NewAccount" class="btn btn-primary" style="cursor:pointer" value="Probeer het nog eens">
    </form>

<?php } ?>


<?php require_once "./includes/footer.php"; ?>
