<?php
require_once 'config.php'; // ajout connexion àbdd 

//si les zones de textes ne sont pas vides et les valeurs existes
if (isset($_GET['villeDepart']) && !empty($_GET['villeDepart']) && isset($_GET['villeArrivee']) && !empty($_GET['villeArrivee']) 
 && isset($_GET['date_co']) && !empty($_GET['date_co']) && isset($_GET['nbPlaces']) && !empty($_GET['nbPlaces'])) {
  $villeDepart = $_GET['villeDepart'];
  $villeArrivee = $_GET['villeArrivee'];
  $date_co = htmlspecialchars($_GET['date_co']);
  $nbPlaces = htmlspecialchars($_GET['nbPlaces']);

  //Comparer (doit etre exacte) les expressions de recherche existantes 
  //comme parametres dans la barre de navigation avec les valeurs stockés dans la bases de données grace à like pour renvoyer le résultat souhaité
  $allCov = $bdd->prepare('SELECT C.idCovoiturage, T.prixCommande,I.nom,I.prenom,I.telephone,
  C.emailConducteur,C.date_co,C.nbPlaces,T.villeDepart, T.villeArrivee, T.prixCommande FROM covoiturages C, trajets T, internautes I
   where C.idTrajet = T.idTrajet AND C.emailConducteur=I.email AND 
   T.villeDepart LIKE "%' . $_GET['villeDepart'] . '%" AND T.villeArrivee LIKE "%' . $_GET['villeArrivee'] 
   . '%" AND C.date_co LIKE "%' . $date_co . '%" AND C.nbPlaces LIKE "%' . $nbPlaces . '%" ORDER BY T.prixCommande DESC');
  $allCov->execute();
  $nbr_co = $allCov->rowCount();
} else {
  (header('Location:index.php?search_err=erreur'));
  die();
}

?>
<!doctype html>
<html lang="fr">

<head>

  <!-- Main css -->
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recherche page</title>
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
        session_start();
        require_once 'config.php';
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
  
  <div class="container " style="margin-top: 100px; width: 1015px;">


    <div class=" align-content-around flex-wrap">
      <div class=" d-flex justify-content-center">
        <h1 class="text-center"> Résultats de covoiturages entre <span style="color: #054752;"><?php echo ucfirst($villeDepart) ?></span> et <span style="color: #054752;"><?php echo ucfirst($villeArrivee) ?></span>
      </div>
      <div class=" d-flex justify-content-left">
        <b class="text-left"><?php setlocale(LC_TIME, ['fr.UTF-8', 'fra.UTF-8', 'fr_FR.UTF-8',  'french.UTF-8']);
                              echo strftime(' %a %d %B %Y', strtotime($date_co)) ?> </b>
      </div>
      <div class="row justify-content-between  mt-3">
        <div class="d-flex align-content-around flex-wrap col-6 ">
          <span style="font-family: Poppins,sans-serif; font-size: 17px"> <b><?php echo $nbr_co ?></b> <?php if ($nbr_co == 1 || $nbr_co == 0) {
                                                                                                        ?> annonce en covoiturage trouvée <?php } else {
                                                                                                                    ?> annonces en covoiturage trouvées<?php } ?> </span>
        </div>

        <div class=" align-content-around flex-wrap  col-4">
          <a href="index.php" type="" name="" class="next_button deactivate-btn mt-3"> NOUVELLE RECHERCHE&nbsp;<i class="bi bi-arrow-right"></i></a>

        </div>
      </div>
      <?php

      // si le nombre de ligne > à 0 , existe de résultat
      if ($allCov->rowCount() > 0) {
            // recupérer la liste des covoiturages retournées comme résultat de recherche
        while ($data = $allCov->fetch()) {
      ?>
          <div class="card mt-5 mb-5" style="height: 200px; padding-top: 18px"> 
            <div class="card-body">
              <div class="row align-center justify-start" style="margin-right: -4px; margin-left: -4px;">
                <div class="col-2 align-self-center">
                  <i class="bi bi-car-front-fill" style="margin-left: 25%; font-size: 75px; color: #92e3a9;"></i>

                </div>

                <div class="col-10 align-self-center ">
                  <div class="row align-center border-bottom pb-2" style="margin-right:-4px; margin-left:-4px;">
                    <div class="col col-2">
                      <div class="d-flex flex-column">
                        <div><strong><?php setlocale(LC_TIME, ['fr.UTF-8', 'fra.UTF-8', 'fr_FR.UTF-8',  'french.UTF-8']);
                                      echo ucfirst(strftime('%A', strtotime($data['date_co']))) ?></strong></div>
                        <div><?php setlocale(LC_TIME, ['fr.UTF-8', 'fra.UTF-8', 'fr_FR.UTF-8',  'french.UTF-8']);
                              echo strftime(' %d %b', strtotime($data['date_co'])) ?></div>
                      </div>
                    </div>
                    <div class="col col-6 align-self-center">
                      <div class="row align-start justify-center" style="margin-right:-4px; margin-left:-4px;">
                        <div class="col-4 text-left">
                          <span><?php echo  $data['villeDepart'] ?></span>
                        </div>
                        <div class="col-1" style="padding-left: 20px;">
                          <i class="bi bi-circle-fill" style="color: #054752;"></i>
                        </div>
                        <div class="col-1" style="padding: 0%;">
                          <hr style="height:6px;border-width:0;color:#054752;background-color:#054752 ; margin: 10px -1px ; opacity: 2.25;">
                        </div>
                        <div class="col-1 " style="padding: 0%; ">
                          <i class="bi bi-circle-fill" style="color: #054752;"></i>
                        </div>
                        <div class="col-4 text-left  mr-n4">
                          <span><?php echo  $data['villeArrivee'] ?></span>
                        </div>
                      </div>
                    </div>
                    <div class="col col-2  align-self-center">
                      <span style="font-size: 18px;"><?php echo  $data['nbPlaces'] ?>&nbsp;<i class="bi bi-person"></i>
                      </span>
                    </div>
                    <div class="col col-2 text-end align-self-center" style="font-size: 1.40rem ;">
                      <span><?php echo  $data['prixCommande'] ?>€</span>
                    </div>
                  </div>
                  <div class="row align-center">
                    <div class="col col-1">
                      <div><span class="bi bi-person-circle" style="color: #b5b3b4; font-size: 50px; text-shadow: 0 0 2px;"></span>
                      </div>
                    </div>
                    <div class="col col-5 d-flex align-items-center ">
                      <div class="">
                        <div><strong><?php echo  ucfirst($data['nom'])  ?>&nbsp;<?php echo  ucfirst($data['prenom']) ?>.</strong></div>
                        <div><?php echo  $data['emailConducteur'] ?></div>
                        <div><?php echo  $data['telephone'] ?></div>
                      </div>
                    </div>
                    <div class="col col-2 d-flex  align-items-center" style="margin-left: 180px; flex: 1 0 0%;">

                      <form method="POST" action="reserver.php">

                        <a href="CovDetails.php?idCovoiturage=<?php echo $data['idCovoiturage'] ?>"  type="" class="c_button deactivate-btn mt-3" name="bouttonS">VOIR DETAILS</a>

                      </form>

                      <!-- 
                         data-toggle="modal" data-target="#myModal"
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content rounded-3 shadow">
                            <div class="modal-body p-4 text-center">
                              <i class="bi bi-x-circle" style="color:#ce3242; font-size:40px"></i>

                              <h5 class="mb-0">Confirmez-vous votre réservation?</h5>
                            </div>
                            <div class="modal-footer flex-nowrap p-0">
                              <button type="button" class="btn btn-lg fs-6 col-6 m-0 rounded-0 border-end" style="color: #58b372;"><strong>Oui, confirmer</strong></button>
                              <button type="" class="btn btn-lg fs-6 col-6 m-0 rounded-0" data-bs-dismiss="modal" style="color:#ca2b55 ;">Annuler</button>
                            </div>
                          </div>
                        </div>
                      </div> -->


                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        <?php
        }
      } else { ?>
        <p style="font-weight: bold">Réessayer en modifiant votre recherche ? Un autre itinéraire ?</p>
      <?php
      }

      ?>

    </div>

  </div>
  
  <!--Js-->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
      $('.alert').alert()
    });

    $(document).ready(function() {

      window.setTimeout(function() {
        $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
          $(this).remove();
        });
      }, 5000);

    });
    $('#myModal').modal('show') // initializes and invokes show immediately
  </script>

</body>

</html>