<!--suppress ALL -->
<p>
	<br/>
	<br/>
</p>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<!--<a class="navbar-brand" href="#">Carnet de Rendez-vous</a>-->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse" id="navbarColor01" style="margin: 0;">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item<?php if ($_GET["active"] == 1 || !isset($_GET["active"])) echo " active"; ?>">
				<a class="nav-link" href="<?php if ($_GET["active"] == 1 || !isset($_GET["active"])) echo "#"; else echo "index.php"; ?>">Accueil</a>
			</li>
			<li class="nav-item<?php if ($_GET["active"] == 2) echo " active"; ?>">
				<a class="nav-link" href="<?php if ($_GET["active"] == 2) echo " #"; else echo "editCreneau.php"; ?>">Ajouter un Créneau</a>
			</li>
		</ul>
	</div>
	
	<script src="bootstrap/jquery/jquery-3.2.1.min.js"></script>
	<script src="bootstrap/bootstrap/js/bootstrap.min.js"></script>
</nav>