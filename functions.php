<?php
require "./config/config.php";

function dd($var){
    die(var_dump($var));
}


if($_GET['action'] == 'create'){
    try {
        $stmt = $conn->prepare("INSERT INTO  list(ID,user_id, task, status, deadline)
        VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([null, $_SESSION['ID'] , $_POST['task'], $_POST['status'], $_POST['deadline'] ]);

        header("Location: index.php");

    } catch (PDOException $e) {
        echo "Er gaat iets mis bij het toevoegen van de taak. " . $e;
    }
}


if($_GET['action'] == 'update'){
    try {

        $sql = 'UPDATE list SET task = ?, status = ?, deadline = ? WHERE' . $_GET['id'] . '= id' ;

        $sth = $dbh->prepare($sql);
        $sth->bindParam(1, $oldDate);
        $sth->bindParam(2, $newDate);
        $sth->execute();


    } catch (PDOException $e) {
        echo "Er gaat iets mis bij het toevoegen van de taak. " . $e;
    }
}