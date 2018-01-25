<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="navbar-collapse collapse" id="navbarColor01">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item<?php if ($_GET["active"] == 1 || !isset($_GET["active"])) echo " active"; ?>">
				<a class="nav-link" href="<?php if ($_GET["active"] == 1 || !isset($_GET["active"])) echo "#"; else echo "index.php"; ?>">Accueil</a>
			</li>
			<li class="nav-item<?php if ($_GET["active"] == 2) echo " active"; ?>">
				<a class="nav-link" href="<?php if ($_GET["active"] == 2) echo " #"; else echo "editCreneau.php"; ?>">Ajouter un Créneau</a>
			</li>
		</ul>
	</div>
</nav>