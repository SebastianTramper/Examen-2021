<?php

require_once "./config/config.php"; 

$username = $_POST['username'];
$password = $_POST['password'];

$userResult = $conn->prepare("SELECT * FROM users WHERE username=?");
$userResult->execute([$username]);
$rowUser = $userResult->fetch();

if (password_verify($password, $rowUser['password'])) {

    $_SESSION['ID']   = $rowUser['id'];
    $_SESSION['UserRole'] = $rowUser['role'];
    $_SESSION['Username']  = $rowUser['username'];
    $_SESSION['name']  = $rowUser['name'];


    if ($_SESSION['UserRole'] == 1) {

        header("Location: dashboard/default.php");
    }

    if ($_SESSION['UserRole'] == 2) {
        header("Location: dashboard/admin.php");
    }

}else{
    header("Location: dashboard/error.php");
}
?>



