<?php 
require_once "./config/config.php";
require_once "./includes/head.php"; 



 if (!isset($_POST['login']) && !isset($_POST['NewAccount'])) { ?>
    <div class="row">
        <div class="col-md-6">
        <h1></h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Animi ut labore illum nisi quaerat numquam a quis tempore ipsam, impedit laborum ab rerum beatae aut asperiores sit aspernatur! Perspiciatis, debitis. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam minus laboriosam eaque, aperiam veritatis, alias dolor qui beatae fugiat nam delectus maiores voluptates possimus ratione totam non voluptatibus ad odit.</p>
            <?php if (!$_SESSION['Username']) { ?>
            <form action="/" method="POST" class="mb-0">
                <input type="submit" name="login" class="btn btn-primary mb-3" style="cursor:pointer" value="Maak een reservering">
            </form>
            <?php }else{ ?>
                <a href="./dashboard/default.php" class="btn btn-primary mr-3">Maak een reservering</a>
            <?php } ?>

            <?php if ($_SESSION['UserRole'] == 2) { ?>
                <a href="./dashboard/admin/index.php" class="btn btn-success">Administrator overzicht</a>
            <?php } ?>

        </div>
        <div class="col-md-5 offset-md-1">
            <img src="src/images/ice.jpg" alt="ice" class="img-fluid">
        </div>
    </div>
<?php } ?>

<?php if (!isset($_POST['NewAccount'])) { ?>
    <?php if (isset($_POST['login'])) { ?>

    <!-- Login -->
    <form action="login.php" method="POST" class="needs-validation" novalidate>
        <h1>Login met jou account</h1>
        <div class="mb-3">
            <input type="text" class="form-control" name="username" placeholder="Gebruikersnaam" required>
            <div class="invalid-feedback">
                Dit veld is verplicht om in te vullen!
            </div>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Wachtwoord" required>
            <div class="invalid-feedback">
                Dit veld is verplicht om in te vullen!
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Login" name="submit">
    </form>

    <form action="#" method="POST">
        <input type="submit" name="NewAccount" class="bg-white border-0 text-primary py-4" style="cursor:pointer" value="Of maak een account aan.">
    </form>
    <?php } ?>
<?php } ?>


<?php if (isset($_POST['NewAccount']) && !isset($_POST['ExistingAccount'])) { ?>

    <!-- Register -->
    <form action="register.php" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="honeypod">
        <h1>Maak een nieuw account aan</h1>
        <div class="mb-3">
            <input type="text" name="username" placeholder="Gebruikersnaam" class="form-control" required>
            <div class="invalid-feedback">
                Dit veld is verplicht om in te vullen!
            </div>
        </div>
        <div class="mb-3">
            <input type="text" name="email" placeholder="E-mailadres" class="form-control" required>
            <div class="invalid-feedback">
                Dit veld is verplicht om in te vullen!
            </div>
        </div>
        <div class="mb-3">
            <input type="text" name="phone" placeholder="Telefoonnummer" class="form-control" required>
            <div class="invalid-feedback">
                Dit veld is verplicht om in te vullen!
            </div>
        </div>
        <div>
            <input type="password" name="password" placeholder="Wachtwoord"  class="form-control" required><br>
            <div class="invalid-feedback mb-3">
                Dit veld is verplicht om in te vullen!
            </div>
        </div>
        <div class="mb-3">
            <input type="password" name="passwordVerify" placeholder="Verifieer Wachtwoord" class="form-control" required>
            <div class="invalid-feedback">
                Dit veld is verplicht om in te vullen!
            </div>
        </div>
        <div class="mb-3">
            <input type="text" name="name" placeholder="Naam" class="form-control" required>
            <div class="invalid-feedback">
                Dit veld is verplicht om in te vullen!
            </div>
        </div>
        <div class="mb-3">
            <input type="text" name="adress" placeholder="Adres" class="form-control" required>
            <div class="invalid-feedback">
                Dit veld is verplicht om in te vullen!
            </div>
        </div>
        <div class="mb-3">
            <input type="text" name="town" placeholder="Plaats" class="form-control" required>
            <div class="invalid-feedback">
                Dit veld is verplicht om in te vullen!
            </div>
        </div>
        <div class="form-check my-3">
            <input class="form-check-input" type="radio" name="member" value="0" id="member2" checked>
            <label class="form-check-label" for="member2">
                Ik ben geen lid
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" value="1" name="member" id="member1" >
            <label class="form-check-label" for="member1">
                Ik ben lid
            </label>
        </div>
        <input type="submit" value="Registeer" name="submit" class="btn btn-primary mt-4"><br>
    </form>

    <form action="#" method="POST">
        <input type="submit" name="ExistingAccount" class="bg-white border-0 text-primary py-4" style="cursor:pointer" value="Of heb je al een account">
    </form>

<?php }?>
    </section>

<?php require_once "./includes/footer.php"; ?>