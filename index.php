<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="bootstrap/bootstrap/css/bootstrap-journal.min.css" />
		<link rel="stylesheet" href="bootstrap/css/style.css" />
		<title>TP6 - Gestion d'un Carnet de Rendez-Vous</title>
	</head>
	
	<?php
	require_once('Controllers/ProfesseurController.php');
	require_once('Controllers/CreneauController.php');
	require_once('Models/Creneau.php');
	?>
	
	<body onload="updateNote();">
		<header class="page-header navbar fixed-top navbar-dark bg-primary">
			<div class="container">
				<h1 class="navbar-brand">Carnet de Rendez-vous</h1>
			</div>
		</header>
		
		<div class="container">
			<?php
			$_GET["active"] = 1;
			include("Templates/navbar.php");
			?>
			
			<section class="row col-12">
				<?php
				ProfesseurController::afficherProfesseurs();
				CreneauController::afficherCreneaux();
				?>
				<form action="editCreneau.php" method="post">
					<input type="hidden" id="ajouter" name="ajouter" value="true"/>
					<input type="submit" value="Ajouter un Créneau" class="btn btn-primary"/>
				</form>
			</section>
		</div>
		
		<script src="bootstrap/jquery/jquery-3.2.1.min.js"></script>
		<script src="bootstrap/bootstrap/js/bootstrap.min.js"></script>
		<script src="formScript.js"></script>
	</body>
</html>