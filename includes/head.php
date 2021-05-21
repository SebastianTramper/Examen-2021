<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body class="d-flex flex-column h-100 pt-5">
<section class="container mt-5 pt-5">

<style>
.nav-item *{
    color: #fff;
}
</style>

<header> 
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark w-100">
        <div class="container">
        <div>
        <a class="navbar-brand" href="/">Schaatsbaan de Klapschaats</a>
        </div>
            <div class="float-right" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <?php if(empty($_SESSION['Username'])){ ?>
                        <li class="nav-item d-flex align-items-center">
                            <form action="/" method="POST" class="mb-0">
                                <input type="submit" name="login" class="bg-dark border-0" style="cursor:pointer" value="Inloggen">
                            </form>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <form action="/" method="POST" class="mb-0">
                                <input type="submit" name="NewAccount" class="bg-dark border-0" style="cursor:pointer" value="Registeren">
                            </form>
                        </li>
                    <?php }  ?>
  
                 
                    <?php if(!empty($_SESSION['Username'])){ ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="https://ex83488.ict-lab.nl/logout.php">Uitloggen</a>
                        </li>
            
                   <?php  if($_SESSION['UserRole'] == 1){ ?>
                        <li class="nav-item">
                            <a href="https://ex83488.ict-lab.nl/dashboard/account.php?id=<?= $_SESSION['ID'] ?>" class="nav-link active">Mijn overzicht</a>
                        </li>
                    <?php }

                    if($_SESSION['UserRole'] == 2){ ?>
                            <li class="nav-item ">
                                <a href="https://ex83488.ict-lab.nl/dashboard/admin" class="nav-link active">Admin overzicht</a>
                            </li>
                    <?php } ?>
                    

                        <li class="nav-item">
                            <span class="nav-link active">  Welkom <?php echo $_SESSION['name'];  ?></span>
                        </li>
                    <?php } ?>
                    
                
              
                </ul>
        </div>
        </div>
    </nav>
</header>
