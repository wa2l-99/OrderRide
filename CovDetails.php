<?php
//pour utiliser la fonction header() (pour les redirections) n'importe où sur lz page même s'il y a du code HTML avant
ob_start();
session_start();
require_once 'config.php'; // ajout connexion bdd 

// si la session existe pas soit si l'on est pas connecté on redirige vers la page de connexion 
// isset :  Détermine si la variable est déclarée (existe dans la session) et est différente de null 
if (!isset($_SESSION['connecter'])) {
    header('Location:login.php?connect_err=erreur');
    die();
}

if (isset($_GET['idCovoiturage'])) {

    $co_id = $_GET['idCovoiturage'];

    //recuperer les détails d'un covoiturage recherché par son id (l'id de cov qui en parametre)
    $query = 'SELECT T.prixCommande,I.nom,I.prenom,I.telephone,C.emailConducteur,C.date_co,C.nbPlaces,T.villeDepart, T.villeArrivee, T.prixCommande FROM covoiturages C, trajets T, internautes I
    where C.idTrajet = T.idTrajet AND C.emailConducteur=I.email and idCovoiturage = :idCovoiturage LIMIT 1';
    $stmt = $bdd->prepare($query);
    $data = ['idCovoiturage' => $co_id];
    $stmt->execute(['idCovoiturage' => $co_id]);

    $result = $stmt->fetch(PDO::FETCH_OBJ);
};
?>
<!doctype html>
<html lang="fr">

<head>

    <!-- Main css -->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cov page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>


    <nav class="navbar navbar-expand-sm bg-light fixed-top shadow mb-5 bg-white ">
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
                <div class="d-flex">
                    <a href="pub-covoit.php" class="icon-plus">
                        <span class="bi bi-plus-circle" style="color :#92e3a9; font-size: x-large; margin-right:50px"><b style="font-size:20px ;"> Publier Trajet</b></span>
                    </a>

                </div>
                <?php
                if (!isset($_SESSION['connecter'])) {
                ?>
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a href="#" id="navbarDropdownMenuLink" class="nav-link dropdown-toggle" style="color:#263238 ;" data-toggle="dropdown"> <i class="bi bi-person-circle" style="color :#92e3a9; font-size: xx-large;"></i></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="login.php">Connexion</a></li>
                                    <li><a class="dropdown-item" href="Inscription.php">Inscription </a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php
                } elseif (isset($_SESSION['connecter'])) {
                ?>
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
                <?php
                }
                ?>
            </div>
        </div>
    </nav>
    <div class="container " style="margin-top: 100px; width: 900px; display:block">


        <div class=" align-content-around flex-wrap">

            <div class="card mt-2 mb-5">
                <div class="card-header">
                    <div class=" d-flex justify-content-left">
                        <h2 class="text-left" style="color: #054752;"> <b>Détails Covoiturage</b></h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-center justify-start" style="margin-right: -4px; margin-left: -4px;">

                        <div class="col-10 align-self-center ">
                            <div class="mb-1 text-muted" style="font-size:25px; color:grey"><strong><?php setlocale(LC_TIME, ['fr.UTF-8', 'fra.UTF-8', 'fr_FR.UTF-8',  'french.UTF-8']);
                                                                                                    echo ucfirst(strftime('%a %d %B', strtotime($result->date_co))) ?></strong></div>
                            <div class="row justify-content-between">
                                <div class="col-6">
                                    <div class="d-flex">
                                        <div class="v-item">
                                            <div class="v-item__dot">
                                                <div class="v-item__inner-dot">
                                                    <div class="v-avatar" style="height: 48px;min-width: 48px;width: 48px;"><i class="bi bi-house-door-fill" style="padding-bottom: 13px ;color: white; "></i></div><span class="v-tooltip v-tooltip--right"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2" style="color: rgb(5, 71, 82);font-size: 18px;"><strong><?= $result->villeDepart; ?></strong></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="verticale-line"></span>

                        <div class="row mb-2">
                            <div class="d-flex">
                                <div class="v-item">
                                    <div class="v-item__dot">
                                        <div class="v-item__inner-dot">
                                            <div class="v-avatar" style="height: 48px;min-width: 48px;width: 48px;"><i class="bi bi-flag-fill" style="padding-bottom: 13px ; color: white;"></i></div><span class="v-tooltip v-tooltip--right"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2" style="color: rgb(5, 71, 82);font-size: 18px;"><strong><?= $result->villeArrivee; ?></strong></div>
                            </div>
                        </div>

                    </div>

                </div>
                <hr style="border: none;background-color: rgb(189 189 189);height: 8px; margin: 0px;">
                <div class="row align-center justify-start" style="margin-right: -4px; margin-left: -4px;">
                    <div class="d-flex">
                        <div class="p-2" style="width: 90% ;"><strong style="color:#919fa2;font-size: 18px"> Prix total pour 1 passager</strong></div>
                        <div class="p-2 flex-shrink-1" style="color: rgb(5, 71, 82);font-size: 20px;"><b><?= $result->prixCommande; ?>€</b></div>
                    </div>
                </div>
                <hr style="border: none;background-color: rgb(189 189 189);height: 8px; margin: 0px;">
                <div class="row align-center justify-start" style="margin-right: -4px; margin-left: -4px;">
                    <div class="col col-1 align-self-center">
                        <div><span class="bi bi-person-circle" style="color: #054752; font-size: 50px; text-shadow: 0 0 1px;"></span>
                        </div>
                    </div>
                    <div class="col col-8 d-flex align-items-center ">
                        <div class="">
                            <div><strong style="font-size: 18px; color: #054752;"><?= ucfirst($result->prenom); ?>.</strong></div>
                            <div style="font-size: 18px;  color: #054752;"><?= $result->telephone; ?></div>
                        </div>
                    </div>
                    <div class="col col-3 d-flex" style=" justify-content: end;">
                        <a href="mailto: <?= $result->emailConducteur; ?>" type="" name="" class="mt-3" name="bouttonS"><i class="bi bi-wechat" style="font-size: 20px;">&nbsp;</i><span style="font-size: 18px;">Contacter <?= ucfirst($result->prenom); ?></span> </a>
                    </div>

                    <div>
                        <p class="pt-3" style='font-size:18px; color: #919fa2'>Je suis flexible pour les horaires au niveau du départ</p>
                    </div>
                </div>
                <hr style="border: none;background-color: rgb(189 189 189);height: 8px; margin: 0px;">
                <div class="row align-center justify-start" style="margin-right: -4px; margin-left: -4px;">

                    <div class="d-flex">
                        <div class="p-2 "><span class='fas fa-smoking-ban' style='font-size:25px'></div>
                        <div class="p-2 " style='font-size:18px;color:#919fa2; '><strong>Je ne voyage pas avec des fumeurs</strong> </div>
                    </div>
                    <div class="d-flex">
                        <div class="p-2 "><img src="img/no-animals.png" alt="" style="width: 25px;height: 25px;"></div>
                        <div class="p-2 " style='font-size:18px;color:#919fa2;'><strong>Je ne préfère pas voyager avec des animaux</strong> </div>
                    </div>
                    <div class="d-flex">
                        <div class="p-2 "><i class='fas fa-user-friends' style='font-size:24px'></i></div>
                        <div class="p-2 " style='font-size:18px;color:#919fa2;'><strong>2 max. à l'arrière</strong> </div>
                    </div>
                </div>
                <hr>

                <?php
                //si le boutton est cliqué
                if (isset($_POST['submit'])) {
                    $id_co = $_GET['idCovoiturage'];
                    $emailPersTrans = $_SESSION['email'];

                    //requete 1 : ajouter covoiturage selectionner à la table transport 

                    $requet_trans = "INSERT INTO transports(idCovoiturage,emailPersTrans) VALUES ('$id_co','$emailPersTrans')";

                    $result = $bdd->prepare($requet_trans);
                    $bdd->beginTransaction();

                    
                    if (isset($id_co) && isset($emailPersTrans)) {
                        //requete 2 : On vérifie si ce covoiturage déja reserver par l'utilisateur connecté
                        $check = $bdd->prepare('SELECT idCovoiturage,emailPersTrans FROM transports WHERE idCovoiturage = ? and emailPersTrans = ?');
                        $check->execute(array($id_co, $emailPersTrans));
                        //fecth: retourne la ligne de resultat suivante sous forme d'in tableau
                        $data = $check->fetch();
                        // retourner le nombre de ligne récuperer
                        $row = $check->rowCount();

                        //Si la requete renvoie un 0 alors le covoiturage n'existe pas dans la table transport et n'est pas reserver 
                        if (($row) == 0) {
                            if ($result->execute(array($id_co, $emailPersTrans))) {
                                    // requete 3 : pour chaque covoiturage choisi le nombre de place est mis à jour ( diminuer de 1)
                                    $requet_update =  $bdd->prepare("UPDATE covoiturages Set nbPlaces = nbPlaces-1 where idCovoiturage = $id_co ");
                                    $requet_update->execute();
                                // On redirige avec le message de succès
                                header('Location:index.php?insert_err=success');
                                $bdd->commit();
                                die();
                            }
                        }
                    }
                }

                ?>

                <form method="POST" action="">

                    <button class="button_rech mb-3" type="submit" name="submit">CONTINUER</button>
                </form>

            </div>

        </div>
    </div>

    <!--Js-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


    <script type="text/javascript">
        /*$(".activate-btn").click(function() {
            $(".deactivate-btn").style.display = "block";;
        });*/
        document.addEventListener('DOMContentLoaded', () => {
            $('.alert').alert()
        });

        $(document).ready(function() {

            window.setTimeout(function() {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                    $(this).remove();
                });
            }, 3000);

        })
    </script>
</body>

</html>