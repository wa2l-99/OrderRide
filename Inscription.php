<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inscription page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
	<link rel="stylesheet" href="style.css">

</head>

<body>
	<?php
	require('navbar.php')

	?>
	<div class="container text-center">
		<div class="card mb-3" style="max-width: 65%;">
			<div class="card-group shadow-lg">
				<div class="card p-4">
					<div class="card-header pb-lg-0" style="border-color: #92e3a9; background-color: white">
						<h4 class="card-title" style="color: #263238"> My <span class="" style="color:#92e3a9 ;">O</span>rder <span className="" style="color:#92e3a9;">R</span>ide</h5>
					</div>
					<div class="card-body " style="color: #263238">
						<i class="bi bi-person-fill-add" style="color :#92e3a9; font-size: xx-large;"></i>
						<h5>Inscrivez-vous</h5>

						<?php
						if (isset($_GET['reg_err'])) {
							$err = htmlspecialchars($_GET['reg_err']);

							switch ($err) {
								case 'success':
						?>
									<div id="message">
										<div style="padding: 5px;">
											<div class="alert alert-success alert-dismissible fade show" role="alert">
												<strong>Succès</strong> inscription réussie !
												<span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
											</div>
										</div>
									</div>

								<?php
									break;

								case 'pwd_length':
								?>
									<div id="message">
										<div style="padding: 5px;">
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Erreur</strong> mot de passe doit contenir<br> au moins 8 caractères
												<span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
											</div>
										</div>
									</div>

								<?php
									break;

								case 'password':
								?>
									<div id="message">
										<div style="padding: 5px;">
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Erreur</strong> mot de passe différent
												<span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
											</div>
										</div>
									</div>

								<?php
									break;

								case 'email':
								?>
									<div id="message">
										<div style="padding: 5px;">
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Erreur</strong> email non valide
												<span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
											</div>
										</div>
									</div>

								<?php
									break;

								case 'email_length':
								?>
									<div id="message">
										<div style="padding: 5px;">
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Erreur</strong> email trop long
												<span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
											</div>
										</div>
									</div>

								<?php
									break;
								case 'tel_length':
								?>
									<div id="message">
										<div style="padding: 5px;">
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Erreur</strong> num tel trop long
												<span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
											</div>
										</div>
									</div>

								<?php
									break;
								case 'prenom_length':
								?>
									<div id="message">
										<div style="padding: 5px;">
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Erreur</strong> prenom trop long
												<span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
											</div>
										</div>
									</div>
								<?php
									break;

								case 'nom_length':
								?>
									<div id="message">
										<div style="padding: 5px;">
											<div class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Erreur</strong> nom trop long
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
											<div id="inner-message" class="alert alert-danger alert-dismissible fade show" role="alert">
												<strong>Erreur</strong> compte deja existant
												<span type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></span>
											</div>
										</div>
									</div>
						<?php


							}
						}
						?>

						<form action="inscription_traitement.php" method="post">
							<div class="input-group  mb-3">
								<span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
								<input type="text" class="form-control" name="nom" placeholder="Nom utilisateur" required>
							</div>
							<div class="input-group  mb-3">
								<span class="input-group-text" id="basic-addon1"><i class="bi bi-person"></i></span>
								<input type="text" class="form-control" name="prenom" placeholder="Prénom utilisateur" required>
							</div>
							<div class="input-group  mb-3">
								<span class="input-group-text" id="basic-addon1"><i class="bi bi-telephone"></i></span>
								<input type="number" class="form-control" name="telephone" placeholder="Téléphone" required>
							</div>

							<div class="input-group  mb-3">
								<span class="input-group-text" id="basic-addon1">@</i></span>
								<input type="email" name="email" class="form-control" placeholder="Email address" required>
							</div>

							<div class="input-group  mb-3">
								<span class="input-group-text" id="basic-addon1"><i class="bi bi-lock"></i></span>
								<input type="password" name="motDePasse" class="form-control" placeholder="Mot de passe" required>
							</div>
							<div class="input-group  mb-3">
								<span class="input-group-text" id="basic-addon1"><i class="bi bi-lock"></i></span>
								<input type="password" name="retape_motDePasse" class="form-control" placeholder="Re-tapez le mot de passe" required>
							</div>
							<div class="buttons">
								<button class="btn" type="submit" value="submit" name="inscrire" style="background-color: #92e3a9; color: rgb(255, 255, 255);" aria-disabled="false" aria-label="Créer">S'inscrire</button>
								<button class="btn" type="reset" value="submit" name="reset" style="background-color: #dde6e0; color: #263238;" aria-disabled="false" aria-label="Créer">Réinitialiser</button>
							</div>
							<div class="create">
								<p>
									<span class="text-muted">Déja membre&nbsp;?</span><a id="createAccount" href="login.php">Connectez-vous</a>
								</p>
							</div>
						</form>
					</div>

				</div>
				<div class="card text-white py-5 d-md-down-none" style=" width: 28em ">

					<img id="img2" src="img/ride.svg" />
				</div>
			</div>
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