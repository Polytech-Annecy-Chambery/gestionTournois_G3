<?php 
$title = 'Accueil';
$style = "home.css";
ob_start();
?>

<div class="content">
<h1>LE MEILLEUR GESTIONNAIRE DE COMPÉTITIONS SPORTIVES</h1>
<h3>Organisez les meilleures compétitions avec notre gestionnaire de tournois. Notre logiciel en ligne d'organisation de compétitions vous permet de créer un tournoi en quelques minutes.</h3>
	
<div class="button_container">
	<form method="post">
		<button type="submit" name="action" value="page_addTournament">
			Ajouter un tournoi
		</button>
	</form>

	<form method="post">
		<button type="submit" name="action" value="page_addTeam">
			Ajouter une équipe
		</button>
	</form>
	</div>
</div>

<?php 
$content = ob_get_clean();
require('template.php'); 
?>