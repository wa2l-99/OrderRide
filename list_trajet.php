<?php
session_start();
require_once 'config.php'; // ajout connexion bdd 

// si la session existe pas soit si l'on est pas connecté on redirige
if (!isset($_SESSION['connecter'])) {
    header('Location:login.php');
    die();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste covoiturages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body class="list_c">
    <?php

    //requete select permet de récuperer tous les covoiturages qui sont publier par l'utilisateur qui est connecté
    $result = $bdd->prepare('SELECT C.date_co,C.nbPlaces,T.villeDepart, T.villeArrivee, T.prixCommande FROM covoiturages C, trajets T where C.idTrajet = T.idTrajet and emailConducteur = :emailConducteur Order by date_co Desc');
    //passer un tableau en parametre dans execute
    $result->execute(['emailConducteur' => $_SESSION['email']]);

    $nbr_co = $result->rowCount();
    ?>
    <nav class="navbar navbar-expand-sm bg-light shadow fixed-top mb-5 bg-white ">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"> <img class="image" src="img/car-pana.svg" width="80" height="50" class="d-inline-block align-top" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <div class="navbar-nav me-auto">
                    <span class="mb-0 h3" style="color:#92e3a9 ;">O</span><span class="mb-0 h3" style="color:#263238 ;">rder</span><span class="mb-0 h3" style="color:#92e3a9;">&nbsp;R</span><span class="mb-0 h3" style="color:#263238;">ide</span>

                </div>

                <div id="trajet">
                    <div class="d-flex">
                        <b> Vos trajets <i style="color: #ca2b55;" class="bi bi-geo-fill"></i></b>
                    </div>
                </div>
                <div class="d-flex">
                    <a href="pub-covoit.php" class="icon-plus">
                        <span class="bi bi-plus-circle" style="color :#92e3a9; font-size: x-large; margin-right:50px"><b style="font-size:20px ;"> Publier Trajet</b></span>
                    </a>

                </div>
                <div class="d-flex">
                    <a href="#" class="icon-person">
                        <span class="bi bi-person-circle" style="color :#92e3a9; font-size: xx-large; margin-right:23px"><b style="font-size:12px; color: #263238"> <?php echo $_SESSION["prenom_nom"]; ?></b></span>
                    </a>
                </div>
                <div class="d-flex">
                    <a href="deconnexion.php" class="icon-logOut">
                        <span class="bi bi-box-arrow-right" style="color :#92e3a9; font-size: x-large; margin-right:23px"></span>
                    </a>
                </div>


            </div>
        </div>
    </nav>
    <!--
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-interval="false">
       
    <div class="carousel-inner">
            <div class="carousel-item active">
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="white" />
                </svg>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="..." alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="..." alt="Third slide">
            </div>
        </div>
    </div>
-->
    <main>
        <!--<div class="b-example-divider"></div>-->

        <div id='container' class="px-4 py-5" style="display:flexbox ; max-width: 1320px; margin-top:3rem">
            <h4 class="pb-2 border-bottom" style="color:#054752"> <span class="bi bi-car-front-fill position-relative" style="font-size: 30px;">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 13px; margin-left: -10px;">
                        <?php echo $nbr_co ?>
                    </span>
                </span><?php if ($nbr_co == 1) {
                        ?> covoiturage <?php } else {
                                        ?> covoiturages <?php } ?> </h4>



            <div class="row mb-2 py-5">
                <?php
                // recupérer tous les covoiturages de l'utilisateur connecté
                //fetch(PDO::FETCH_OBJ): Récupère la prochaine ligne et la retourne en tant qu'objet
                while ($co = $result->fetch(PDO::FETCH_OBJ)) {

                ?>

                    <div class="col-md-6">
                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static">
                                <div class="mb-1 text-muted" style="font-size:25px; color:"><strong><?php setlocale(LC_TIME, ['fr.UTF-8', 'fra.UTF-8', 'fr_FR.UTF-8',  'french.UTF-8']);
                                                                                                    echo ucfirst(strftime('%a %d %b', strtotime($co->date_co))) ?></strong></div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <i class="bi bi-circle"></i>
                                        <strong style="color: rgb(5, 71, 82);font-size: 18px"><?= $co->villeDepart ?></strong>
                                    </div>
                                    <div class="col-2">
                                        <strong style="color: rgb(5, 71, 82);font-size: 20px">
                                            <?= ROUND($co->prixCommande, 2) ?> €
                                        </strong>

                                    </div>
                                </div>
                                <span class="vertical-line"></span>

                                <div class="row border-bottom pb-2">

                                    <div class="col"><i class="bi bi-circle"></i>
                                        <strong style="color: rgb(5, 71, 82);font-size: 18px"><?= $co->villeArrivee ?></strong>
                                    </div>
                                </div>
                                <div><strong style="color: rgb(5, 71, 82);font-size: 15px"> Nombre de passager :<span style="color: rgb(5, 71, 82);font-size: 18px"> <?= $co->nbPlaces ?></span> </strong> <i class="bi bi-person" style="font-size: 1.25rem; color:darkgrey"></i></div>
                                <div class="d-flex justify-content-end">

                                    <?php
                                    //strtotime permet de convertir la date dans un format donné
                                    $aujourdhui = strtotime(date("Ymd"));
                                    $date = strtotime($co->date_co);
                                    //si la date de covoiturage > à la date d'aujourdhui 
                                    if ($date >=  $aujourdhui) {
                                        // si le nombre de place = 0 => état covoiturage "Complet"
                                        if ($co->nbPlaces == 0) {
                                    ?>
                                            <h5 class="d-inline-block mb-2 text-success" style="color: rgb(5, 71, 82);font-size: 18px"> Complet</h5>
                                        <?php
                                        } else {
                                        ?>
                                            <!-- si le nombre de place !== 0 => affiche le nbre de places restantes -->
                                            <h5 class="d-inline-block mb-2 text-warning" style="color: rgb(5, 71, 82);font-size: 18px">
                                                <?php if ($co->nbPlaces == 1) {
                                                    echo $co->nbPlaces ?> seule place encore diponible <?php 
                                                }
                                                     else {
                                                    echo $co->nbPlaces ?> places encore diponibles <?php } ?> </h5>

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <!-- Si la date d'aujourdhui > la date de covoiturage => état cov "Effectuer" -->
                                        <h5 class="d-inline-block mb-2 text-danger" style="color: rgb(5, 71, 82);font-size: 18px"> Effectuer</h5>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>


            </div>
        </div>

    </main>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        $('.alert').alert()
    });

    $(document).ready(function() {

        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 3000);

    });
</script>

</html>