<!doctype html>
<html lang="en">

<head>
  <!-- Main css -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index page</title>
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
        //ouvrir une session
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

  <?php
  if (isset($_GET['search_err'])) {
    $err = htmlspecialchars($_GET['search_err']);
    switch ($err) {
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
    }
  }
  ?>
<?php
    if (isset($_GET['insert_err'])) {
        $err = htmlspecialchars($_GET['insert_err']);

        switch ($err) {
            case 'success':
    ?>
                <div id="message">
                    <div style="padding: 5px;">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Succès</strong> Votre covoiturage est confirmé <br> avec succées !
                            <span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
                        </div>
                    </div>
                </div>

    <?php
        }
    }
    ?>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/Lyon_1.jpg" alt="" width="100%" height="100%">
      </div>
      <div class="carousel-item">
        <img src="img/Montpellier.jpg" alt="" width="100%" height="100%">
        <div class="container">
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <i class="bi bi-arrow-left-circle-fill" style="font-size:40px; opacity: 1;" aria-hidden="true"></i></a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <i class="bi bi-arrow-right-circle-fill" style="font-size:40px;" aria-hidden="true"></i></a>
  </div>

  <div class="container">
    <div class="card" style="width: 30% ; position:absolute; margin-bottom:42%; z-index: 2;">
      <div class="card-body">
        <h2 class="card-title" style="text-align: center ; color: #054752; ">Où voulez-vous aller ?</h2>

        <form method="GET" action="recherche.php">

          <div class="mb-3">
            <label for="villeDepart" class="form-label"><b>De</b></label>
            <input type="search" class="form-control" name="villeDepart" id="villeDepart" placeholder="Ville de départ" />
          </div>
          <div class="mb-3">
            <label for="villeArrivee" class="form-label"><b>Vers</b></label>
            <input type="search" class="form-control" name="villeArrivee" id="villeArrivee" placeholder="Déstination" />
          </div>
          <div class="mb-3">
            <label for="date" class="form-label"><b>Départ le</b></label>
            <input type="date" id="date_co" name="date_co" class="form-control" />
          </div>
          <label for="nbPlaces" class="form-label"><b>Qui voyage ?</b></label>
          <input id="nbPlaces" class="form-control" name="nbPlaces" type="Number" placeholder="Nombre de passager" />

          <button class="rech_button  mt-3" type="submit" name="envoyer" value="Rechercher"> <i class="bi bi-search"></i>&nbsp;Rechercher les covoiturages</button>


        </form>
      </div>
    </div>

  </div>


  <footer class=" mt-auto py-1 bg-light">
    <div class="container d-flex flex-wrap justify-content-between align-items-center border-top">
      <div class=" d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
          <img class="image" src="img/car-pana.svg" width="50" height="50" class="d-inline-block align-top" alt="">
        </a>
        <span class="mb-3 mb-md-0 text-muted">&copy; 2022 Oreder Ride, Inc</span>
      </div>
      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="#">
            <i class="bi bi-twitter" style=" font-size:x-large"></i>

          </a>
        </li>
        <li class="ms-3"><a class="text-muted" href="#">
            <i class="bi bi-instagram" style=" font-size:x-large"></i>
          </a></li>
        <li class="ms-3"><a class="text-muted" href="#">
            <i class="bi bi-facebook" style=" font-size:x-large"></i>

          </a></li>
      </ul>
    </div>
  </footer>

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
      }, 3000);
    });

    const dateInput = document.getElementById('date_co');
    //  Using the visitor's timezone
    dateInput.value = formatDate();

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
</body>

</html>