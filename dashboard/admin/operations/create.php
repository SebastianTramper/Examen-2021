<?php 



require_once "../../../config/config.php"; 
require_once "../../../includes/head.php"; 

if (isset($_POST['new'])) {  ?>

    <form action="?action=create" method="POST" class="mt-5">
        <h2>Nieuw tijdsblok toevoegen</h2>
        <label for="date">Datum</label>
        <input type="date" id="date" name="date" class="form-control">
        <label for="start_time">Start tijd</label>
        <input type="time" id="start_time" name="start_time" class="form-control" placeholder="Start tijd">
        <label for="end_time">Eind tijd</label>
        <input type="time" id="end_time" class="form-control" name="end_time" placeholder="Eind tijd">
        <div class="mt-4">
            <input type="submit" name="create" class="btn btn-success" value="aanmaken">
            <a href="../index.php" class="btn btn-primary" >Of ga terug</a>
        </div>

    </form>

<?php }

if($_GET['action'] == 'create'){

    try {
        $stmt = $conn->prepare("INSERT INTO  time_blocks(id, start_time, end_time, amount)
        VALUES (?, ?, ?, ?)");
        $stmt->execute([
            null,
            $_POST['date'] . " " . $_POST['start_time'],
            $_POST['date'] . " " . $_POST['end_time'],
            100
           ]);
    
           header("Location: ../index.php");

    } catch (PDOException $e) {
        echo "Er gaat iets mis met het registeren. " . $e;
    }

}

require_once "../../../includes/footer.php"; 
