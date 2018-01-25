<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="bootstrap/bootstrap/css/bootstrap-journal.min.css" />
		<link rel="stylesheet" href="bootstrap/css/style.css" />
		<title>TP6 - Gestion d'un Carnet de Rendez-Vous</title>
	</head>
	
	<?php
	require_once("setup.inc.php");
	require_once('Controllers/ProfesseurController.php');
	require_once('Controllers/CreneauController.php');
	require_once('Models/Creneau.php');
	
	// -1   : AJOUTER
	// >= 0 : MODIFIER
	$mode = -1;
	$creneau = null;
	if (isset($_POST["modifier"]) && $_POST["modifier"] >= 0) {
		$mode = $_POST["modifier"];
		$creneau = CreneauController::getCreneauFromId($mode);
		
		// Si aucun creneau n'a été trouvé avec un tel id, on revient en mode AJOUTER
		if ($creneau == null)
			$mode = -1;
	}
	
	$listeNonProcesse = ProfesseurController::listeProfesseurs();
	$listeProfesseurs = array();
	for ($i = 0; $i < sizeof($listeNonProcesse) ; $i++)
		$listeProfesseurs[$i] = $listeNonProcesse[$i]->getPrenom() . " " . $listeNonProcesse[$i]->getNom();
	?>
	
	<body onload="updateNote();">
		<header class="page-header navbar fixed-top navbar-dark bg-primary">
			<div class="container">
				<h1 class="navbar-brand">Carnet de Rendez-vous - <?php if ($mode >= 0) echo "Modifier"; else echo "Ajouter"; ?> un Créneau</h1>
			</div>
		</header>
		
		<div class="container">
			<?php
			$_GET["active"] = 2;
			include("Templates/navbar.php");
			?>
			
			<section class="row col-12">
				<div class="card text-white bg-primary">
					<div class="card-header">
						<h1 class="col-12"><?php if ($mode >= 0) echo "Modifier"; else echo "Ajouter"; ?> un créneau</h1>
					</div>
					
					<div class="card-body">
						<form name="editCreneau" action="update.php" method="post" onsubmit="return validateForm()">
							<fieldset>
								<div class="form-group">
									<label for="dateDebut">Date de début du créneau :</label>
									<input type="datetime-local" class="form-control" id="dateDebut" name="dateDebut" value="<?php
									if ($mode >= 0) {
										$dt = new DateTime("r", $creneau->getDateDebut());
										echo $dt->format("Y-m-d\TH:i");
									}
									else {
										$dt = new DateTime();
										echo $dt->format("Y-m-d\TH:i");
									}
									?>" required/>
								</div>
								<div class="form-group">
									<label for="duree">Durée : (HH-mm)</label>
									<input type="time" class="form-control" id="duree" name="duree" value="<?php
									if ($mode >= 0)
										echo $creneau->getDuree();
									else
										echo "01:00";
									?>" required/>
								</div>
								<div class="form-group form-check">
									<label for="estExclusif" class="form-check-label">
										<input type="checkbox" class="form-check-input" id="estExclusif" name="estExclusif" <?php
										if ($mode >= 0) {
											if ($creneau->getEstExclusif())
												echo "checked";
										}
										else
											echo "checked";
										?>/>
										Ce créneau est exclusif</label>
								</div>
								<div class="form-group">
									<label for="professeur">Professeur :</label>
									<select id="professeur" name="professeur" title="Professeur" class="form-control" required>
										<option>Choissez un Professeur pour ce créneau</option>
										<?php
										foreach ($listeProfesseurs as $professeur) {
											// TODO: add selected="selected" to the selected option
											echo "<option>$professeur</option>";
										}
										?>
									</select>
								</div>
								<div class="form-group form-check">
									<label for="estLibre" class="form-check-label">
										<input type="checkbox" class="form-check-input" id="estLibre" name="estLibre" <?php
										if ($mode >= 0 && $creneau->getEstLibre())
											echo "checked";
										?>/>
										Ce créneau est libre</label>
								</div>
								<div class="form-group">
									<label for="note">Note :</label>
									<input type="range" class="form-control" id="note" name="note" min="0" max="20" step="1" oninput="updateNote();" required value="<?php
									if ($mode >= 0)
										echo $creneau->getNote();
									else
										echo "10";
									?>"/>
									<p><span id="noteSur20"></span>/20</p>
								</div>
								<div class="form-group">
									<label for="comment1">Commentaire avant la séance :</label>
									<textarea class="form-text" id="comment1" name="comment1" placeholder="Entrer votre commentaire ici..."><?php
									if ($mode >= 0)
										echo $creneau->getCommentaire1();
									?></textarea>
								</div>
								<?php
								if ($mode >= 0)
								{
								?>
								<div class="form-group">
									<label for="comment2">Commentaire après la séance :</label>
									<textarea class="form-text" id="comment2" name="comment2" placeholder="Entrer votre commentaire après le créneau ici..."><?php
									echo $creneau->getCommentaire2();
									?></textarea>
								</div>
								<?php
								}
								?>
								<!-- On envoie aussi le mode à update.php -->
								<input type="hidden" id="mode" name="mode" value="<?php echo $mode; ?>"/>
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