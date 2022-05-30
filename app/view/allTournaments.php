<?php 
$title = 'Voir tous les tournois'; 
$style = "allView.css";
ob_start();
?>

<div id="list_tournois_content">
	<h1 class = "title">Liste des Tournois</h1>
	
	<div class ="lesTournois">
		<?php 
			$compteur = 0;
			while($donnees = $tournaments->fetch_array()){
		?> 
			 						
		<div <?php echo ($compteur % 2==0 ? 'class=unTournoi' : 'class=unTournoiGrey'); ?>>
			<div class="nom"><?php echo $donnees['nom_t']?></div>

			<div class="sport"><?php echo $donnees['sport_t']?></div>

			<div class="form_contain">
				<form id="form_tournament" method='POST'>
					<input type="hidden" name="nom_t" value="<?php echo $donnees['nom_t']?>">	
                    <input type="hidden" name="capacite_t" value="<?php echo $donnees['capacite_t']?>">	
                    <input type="hidden" name="sport_t" value="<?php echo $donnees['sport_t']?>">														
					<button class="button" type="submit" name="action" value="one_tournament">Détails</button>
				</form>

				<form id="form_tournament_delete" method='POST'>
					<input type="hidden" name="nom_t" value="<?php echo $donnees['nom_t']?>">
					<input type="hidden" name="id_t" value="<?php echo $donnees['id_t']?>">
					<button class="button" type="submit" name="action" value="delete_tournament">Supprimer</button>
				</form>
			</div>

		</div>
				
		<?php $compteur = $compteur + 1;} ?>

	</div>

	<form method="post">
		<button class="button_ajout" type="submit" name="action" value="page_addTournament">
			Ajouter un tournoi
		</button>
	</form>

</div>  

<?php 
$content = ob_get_clean();
require('template.php'); 
?>

