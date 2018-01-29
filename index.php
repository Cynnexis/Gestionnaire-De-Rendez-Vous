<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="bootstrap/bootstrap/css/bootstrap-materia.min.css" />
		<link rel="stylesheet" href="bootstrap/css/style.css" />
		<title>TP6 - Gestion d'un Carnet de Rendez-Vous</title>
	</head>
	
	<?php
	require_once('Controllers/ProfesseurController.php');
	require_once('Controllers/CreneauController.php');
	require_once('Models/Creneau.php');
	?>
	
	<body>
		<!-- Header containing the banner -->
		<header class="page-header navbar fixed-top navbar-dark bg-primary">
			<div class="container">
				<h1 class="navbar-brand">Carnet de Rendez-vous</h1>
			</div>
		</header>
		<div class="container">
		
			<!-- Navbar (containing in another file) -->
			<?php
			$_GET["active"] = 1;
			include("Templates/navbar.php");
			?>
			
			<!-- Teachers Table -->
			<section>
				<div class="row">
					<h1>Professeurs</h1>
				</div>
				<div class="row">
					<div class="col-7">
						<?php
						ProfesseurController::afficherProfesseurs();
						?>
					</div>
					<div class="col-5">
					</div>
				</div>
			</section>
			
			<!-- Time Slots Table -->
			<section class="row col-12">
				<h1>Créneaux</h1>
				<?php
				CreneauController::afficherCreneaux();
				?>
			</section>
			
			<!-- Button to add Time Slots -->
			<section class="row col-12">
				<form action="editCreneau.php" method="post" class="col-12">
					<input type="hidden" id="ajouter" name="ajouter" value="true"/>
					<input type="submit" value="Ajouter un Créneau" class="btn btn-primary btn-lg col-12"/>
				</form>
			</section>
		</div>
		
		<script src="bootstrap/jquery/jquery-3.2.1.min.js"></script>
		<script src="bootstrap/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>

