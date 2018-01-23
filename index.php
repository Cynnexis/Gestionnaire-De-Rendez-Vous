<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="bootstrap/bootstrap/css/bootstrap-journal.min.css" />
		<link rel="stylesheet" href="bootstrap/css/style.css" />
		<title>TP6 - Gestion d'un Carnet de Rendez-Vous</title>
	</head>
	
	<body>
		<header class="page-header navbar fixed-top navbar-dark bg-primary">
			<div class="container">
				<h1 class="navbar-brand">Carnet de Rendez-vous</h1>
			</div>
		</header>
		
		<div class="container">
			<section class="row">
				<?php
				require_once("functions_mysqli.inc");
				require_once('Models/Professeur.php');
				require_once('Models/Creneau.php');
				require_once('Controllers/ProfesseurController.php');
				require_once('Controllers/CreneauController.php');
				$connexion = connectionTo("localhost", "root", "", "tp6");
				selectDatabase($connexion, "tp6");
				
				$result = mysqli_query($connexion, "SELECT * FROM professeurs;");
				$professeurs = array();
				$line = mysqli_fetch_row($result);
				for ($i = 0; $line; $i++) {
					$professeurs[$i] = new Professeur($line[0], $line[1], $line[2]);
					$line = mysqli_fetch_row($result);
				}
				ProfesseurController::afficherProfesseurs($professeurs);
				
				$result = mysqli_query($connexion, "SELECT id, UNIX_TIMESTAMP(dateDebut), duree, estExclusif, UNIX_TIMESTAMP(datePublication), idProfesseur, estLibre, note, commentaire1, commentaire2 FROM creneaux;");
				$creneaux = array();
				$line = mysqli_fetch_row($result);
				for ($i = 0; $line; $i++) {
					$creneaux[$i] = new Creneau($line[0], $line[1], $line[2], (bool) $line[3], $line[4], $line[5], (bool) $line[6], $line[7], $line[8], $line[9]);
					$line = mysqli_fetch_row($result);
				}
				CreneauController::afficherCreneaux($creneaux);
				
				disconnectFrom($connexion);
				?>
			</section>
			
			<section class="row">
				<form></form>
			</section>
		</div>
	</body>
</html>