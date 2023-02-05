<?php
session_start();
require_once 'config.php'; // ajout connexion bdd 
// si la session existe pas soit si l'on est pas connecté on redirige
if (!isset($_SESSION['connecter'])) {
    header('Location:login.php?pub_err=erreur');
    die();
}

/*
try {

    $stmt = $bdd->prepare('SELECT idTrajet, villeDepart, villeArrivee, prixCommande FROM trajets');
    $stmt->execute();
    $results = $stmt->fetchAll();
} catch (Exception $ex) {
    echo ($ex->getMessage());
}*/


if (isset($_POST['submit'])) {

    $villeDepart = htmlspecialchars($_POST['villeDepart']);
    $villeArrivee = htmlspecialchars($_POST['villeArrivee']);
    $prixCommande = htmlspecialchars($_POST['prixCommande']);
    $date_co = htmlspecialchars($_POST['date_co']);
    $emailConducteur = htmlspecialchars($_POST['emailConducteur']);
    $nbPlaces = htmlspecialchars($_POST['nbPlaces']);
    
    // inserer un trajet dans la table trajets
    $req = $bdd->prepare("INSERT INTO trajets( villeDepart, villeArrivee, prixCommande) values (?,?,?)");
    $req->execute(array($villeDepart, $villeArrivee, $prixCommande));
    // pour récuperer la derniere id inserer à la base de données
    $idTrajet = $bdd->lastInsertId();
    // inserer un covoiturage dans la table covoiturages en utilisant la derniere id de trajet inserer
    $sql = $bdd->prepare("INSERT INTO covoiturages (idTrajet,date_co,emailConducteur,nbPlaces) VALUES (?,?,?,?)");
    $bdd->beginTransaction();
    if ((!empty($villeDepart) && !empty($villeArrivee)) && !empty(($prixCommande))
     && !empty($date_co) && !empty($emailConducteur) && !empty($nbPlaces)) {
        // On vérifie si le covoiturage  existe
        $check = $bdd->prepare('SELECT idTrajet,date_co,emailConducteur,nbPlaces 
        FROM covoiturages WHERE date_co = ? and nbPlaces = ? and idTrajet = ? and emailConducteur = ? ');
        $check->execute(array($date_co, $nbPlaces, $idTrajet, $_SESSION['email']));
        $data = $check->fetch();
        $row = $check->rowCount();
        //Si la requete renvoie un 0 alors le covoiturage n'existe pas et jamais publier par cet utilisateur
        if (($row) == 0) {
            if ($sql->execute(array($idTrajet, $date_co, $emailConducteur, $nbPlaces)))
                // On redirige avec le message de succès
                header('Location:pub-covoit.php?insert_err=success');
            $bdd->commit();
            die();
        } else {
            (header('Location:pub-covoit.php?insert_err=already'));
            die();
        }
    } else {
        (header('Location:pub-covoit.php?insert_err=erreur'));
        die();
    }
}
$bdd->null;
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Main css -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>
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
                        <b> Publier un Covoiturage</b>
                    </div>
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

    <?php
    if (isset($_GET['insert_err'])) {
        $err = htmlspecialchars($_GET['insert_err']);

        switch ($err) {
            case 'success':
    ?>
                <div id="message">
                    <div style="padding: 5px;">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Succès</strong> Votre annonce est publiée <br> avec succées !
                            <span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
                        </div>
                    </div>
                </div>

            <?php
                break;

            case 'erreur':
            ?>
                <div id="message">
                    <div style="padding: 5px;">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Erreur</strong> Vous devez saisir tous les champs !
                            <span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
                        </div>
                    </div>
                </div>
            <?php
                break;

            case 'already':
            ?>
                <div id="message">
                    <div style="padding: 5px;">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Erreur</strong> annonce deja existante
                            <span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
                        </div>
                    </div>
                </div>

    <?php
        }
    }
    ?>
    <div id="pub-form">
        <div class="card ">
            <div class="card-header">
                <h2 style="color: #054752;"> <b> Proposer votre Covoiturage </b></h2>
            </div>
            <div class="card-body">

                <form method="POST">
                    <div class="row justify-content">

                        <div class=" col-6 mb-3 ">
                            <label for="villeDepart" class="form-label"><b>De</b></label>
                            <input type="text" id="villeDepart" name="villeDepart" class="form-control" placeholder="Ville de départ" />

                        </div>
                        <div class="col-6 mb-3 ">
                            <label for="villeArrivee" class="form-label"><b>Vers</b></label>
                            <input type="text" id="villeArrivee" name="villeArrivee" class="form-control" placeholder="Déstination" />

                        </div>
                    </div>

                    <div class="row justify-content">

                    <div class="col-6 mb-3">
                        <label for="email" class="form-label"><b>Email</b></label>
                        <input type="email" class="form-control" name="emailConducteur" id="emailConducteur" value="<?php echo $_SESSION["email"]; ?>" />
                    </div>

                    <div class="col-6 mb-3">
                        <label for="date" class="form-label"><b>Date</b></label>
                        <input type="date" id="date_co" name="date_co" class="form-control" />
                    </div>

                    </div>
                    
                    <div class="row justify-content">
                        <div class="col-6 mb-3">
                            <label for="nbPlaces" class="form-label"><b>Nombre de places</b></label>
                            <input id="nbPlaces" class="form-control" name="nbPlaces" type="Number" min="1" max="3" placeholder="Nombre de places entre 1 et 3" />
                        </div>
                        <div class="col-6 mb-3">
                            <label for="prixCommande" class="form-label"><b>Prix Covoiturage</b></label>
                            <div class="input-group mb-3">
                                <input id="prixCommande" name="prixCommande" class="form-control" type="Number" min="0" placeholder="Proposer votre prix" />
                                <div class="input-group-append">
                                    <span class="input-group-text" style="border-radius: 0% 10% 10% 0% ; height: 38px"><span class="bi bi-currency-euro"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn activate-btn btn-lg" style="display: block;margin: auto; width:100%; background-color: #92e3a9; color: rgb(255, 255, 255);"> <b>Publier covoiturage</b></button>

                </form>
                <a href="list_trajet.php" type="" name="" class="next_button deactivate-btn mt-3"> Consulter vos trajets &nbsp;<i class="bi bi-arrow-right"></i></a>

            </div>
        </div>

    </div>

    <?php
    require('footer.php')
    ?>

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

        });
        const dateInput = document.getElementById('date_co');

        //  Using the visitor's timezone
        dateInput.value = formatDate();

        console.log(formatDate());

        function padTo2Digits(num) {
            return num.toString().padStart(2, '0');
        }

        function formatDate(date = new Date()) {
            return [
                date.getFullYear(),
                padTo2Digits(date.getMonth() + 1),
                padTo2Digits(date.getDate()),
            ].join('-');
        }
    </script>

    <!--
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type='text/javascript'>
        $().ready(function() {

            $("#menu").change(function() {
                let prixCommande = $(this).find("option:selected").data("prixCommande")
                $("#prixCommande").val(prixCommande)
                console.log(prixCommande);
            })
        })
    </script>
    -->
</body>


</html>