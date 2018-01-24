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
	
	if (!isset($_SESSION)) {
		session_start();
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$_SESSION['postdata'] = $_POST;
		unset($_POST);
		header("Location: ".$_SERVER['PHP_SELF']);
		exit;
	}
	
	$listeNonProcesse = ProfesseurController::listeProfesseurs();
	$listeProfesseurs = array();
	for ($i = 0; $i < sizeof($listeNonProcesse) ; $i++)
		$listeProfesseurs[$i] = $listeNonProcesse[$i]->getPrenom() . " " . $listeNonProcesse[$i]->getNom();
	?>
	
	<body onload="updateNote();">
		<header class="page-header navbar fixed-top navbar-dark bg-primary">
			<div class="container">
				<h1 class="navbar-brand">Carnet de Rendez-vous</h1>
			</div>
		</header>
		
		<div class="container">
			
			<?php
			?>
			
			<section class="row col-12">
				<?php
				ProfesseurController::afficherProfesseurs();
				CreneauController::afficherCreneaux();
				?>
			</section>
			
			<section class="row col-12">
				<div class="card text-white bg-primary">
					<div class="card-header">
						<h1 class="col-12">Ajouter un créneau</h1>
					</div>
					
					<div class="card-body">
						<form name="ajouterCreneau" action="update.php" method="post" onsubmit="return validateForm()">
							<fieldset>
								<div class="form-group">
									<label for="dateDebut">Date de début du créneau :</label>
									<input type="datetime-local" class="form-control" id="dateDebut" name="dateDebut" value="<?php $dt = new DateTime(); echo $dt->format("Y-m-d\TH:i"); ?>" required/>
								</div>
								<div class="form-group">
									<label for="duree">Durée : (HH-mm)</label>
									<input type="time" class="form-control" id="duree" name="duree" value="01:00" required/>
								</div>
								<div class="form-group form-check">
									<label for="estExclusif" class="form-check-label">
										<input type="checkbox" class="form-check-input" id="estExclusif" name="estExclusif" checked/>
										Ce créneau est exclusif</label>
								</div>
								<div class="form-group">
									<label for="professeur">Professeur :</label>
									<select id="professeur" name="professeur" title="Professeur" class="form-control" required>
										<option>Choissez un Professeur pour ce créneau</option>
										<?php
											foreach ($listeProfesseurs as $professeur)
												echo "<option>$professeur</option>";
										?>
									</select>
								</div>
								<div class="form-group form-check">
									<label for="estLibre" class="form-check-label">
										<input type="checkbox" class="form-check-input" id="estLibre" name="estLibre"/>
										Ce créneau est libre</label>
								</div>
								<div class="form-group">
									<label for="note">Note :</label>
									<input type="range" class="form-control" id="note" name="note" min="0" max="20" step="1" oninput="updateNote();" required/>
									<p><span id="noteSur20"></span>/20</p>
								</div>
								<div class="form-group">
									<label for="comment1">Commentaire avant la séance :</label>
									<textarea class="form-text" id="comment1" name="comment1" placeholder="Entrer votre commentaire ici..."></textarea>
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-danger" id="envoyer" name="envoyer" value="Envoyer"/>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</section>
		</div>
		
		<script src="bootstrap/jquery/jquery-3.2.1.min.js"></script>
		<script src="bootstrap/bootstrap/js/bootstrap.min.js"></script>
		<script src="formScript.js"></script>
	</body>
</html>