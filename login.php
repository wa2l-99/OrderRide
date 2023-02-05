<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php
	require('navbar.php')

	?>
	<div class="container text-center " style="height:100%;">
		<div class="card mb-3" style="max-width: 65%;">
			<div class="card-group shadow-lg">
				<div class="card p-4">
					<div class="card-header pb-lg-0" style="border-color: #92e3a9; background-color: white">
						<h4 class="card-title" style="color: #263238">Bienvenue à <span class="" style="color:#92e3a9 ;">O</span>rder <span class="" style="color:#92e3a9;">R</span>ide</h5>
					</div>
					<div class="card-body " style="color: #263238">
						<i class="bi bi-file-lock2 " style="color :#92e3a9; font-size: xx-large;"></i>
						<h5>Connexion</h6>
							<p class="text-muted">Connecter à votre compte </p>
							<?php
							if (isset($_GET['login_err'])) {
								$err = htmlspecialchars($_GET['login_err']);

								switch ($err) {
									case 'erreur':
							?>
										<div id="message">
											<div style="padding: 5px;">
												<div class="alert alert-danger alert-dismissible fade show" role="alert">
													<strong>Erreur</strong> Mauvais login ou mot de passe!
													<span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
												</div>
											</div>
										</div>

								<?php
										break;
								}
							}
							if (isset($_GET['connect_err'])) { ?>

								<div id="message">
									<div style="padding: 5px;">
										<div class="alert alert-primary alert-dismissible fade show" role="alert">
											<strong>Info</strong> Connectez-vous <br> pour pouvoir résrever un covoiturage
											<span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
										</div>
									</div>
								</div>

							<?php
							}
							if (isset($_GET['pub_err'])) { ?>

								<div id="message">
									<div style="padding: 5px;">
										<div class="alert alert-primary alert-dismissible fade show" role="alert">
											<strong>Info</strong> Connectez-vous <br> pour pouvoir publier un covoiturage
											<span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
										</div>
									</div>
								</div>

							<?php
							} ?>
							<div class="login-form">
								<form action="connexion.php" method="post">

									<div class="input-group  mb-3">
										<span class="input-group-text"><i class="bi bi-person"></i></span>
										<input type="email" name="email" class="form-control" placeholder="Email address" required="required" autocomplete="off">
									</div>

									<div class="input-group  mb-3">
										<span class="input-group-text"><i class="bi bi-lock"></i></span>
										<input type="password" name="motDePasse" class="form-control" required="required" placeholder="Mot de passe" autocomplete="off">
									</div>
									<button class="w-100 btn " type="submit" style="background-color: #92e3a9; color: rgb(255, 255, 255);">S'identifier</button>
									<div class="create">
										<p>
											<span class="text-muted">Vous n’avez pas de compte&nbsp;?</span><a id="createAccount" href="Inscription.php">Inscrivez-vous</a>
										</p>
									</div>
								</form>
							</div>

					</div>

				</div>
				<div class="card text-white py-5 d-md-down-none" style=" width: 28em ">

					<img id="img1" src="img/car.svg" />
				</div>
			</div>
		</div>

	</div>
	</div>
	<?php
	require('footer.php')
	?>
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
	</script>
</body>

</html>