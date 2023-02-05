<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>navbar </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">

  
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-light shadow mb-5 bg-white ">
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
        <div class="d-flex">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a href="#" id="navbarDropdownMenuLink" class="nav-link dropdown-toggle" style="color:#263238 ;" data-toggle="dropdown"> <i class="bi bi-person-circle" style="color :#92e3a9; font-size: xx-large;"></i></a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="login.php">Connexion</a></li>
                <li><a class="dropdown-item" href="Inscription.php">Inscription</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

 
</body>

</html>