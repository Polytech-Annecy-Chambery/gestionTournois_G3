<?php 
$title = 'Gestion Tournois';
$style = "home.css"; 
ob_start();

?>


<content>

<div class="content">
<h1>LE MEILLEUR GESTIONNAIRE DE COMPÉTITIONS SPORTIVES</h1>
<h2>Organisez les meilleurs compétitions avec notre gestionnaire de ligues et tournois. Notre logiciel en ligne d'organisation de compétitions vous permet de créer un tournoi en quelques secondes.</h2>
	
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
</content>

<?php 
$content = ob_get_clean();
require('template.php'); 
?>