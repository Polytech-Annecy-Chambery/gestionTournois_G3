<?php 
$title = 'Gestion Tournois';  // Set the page Title
$style = "allTournaments.css"; // Set the corresponding stylesheet


?>

<?php ob_start(); // Initialize content start ?>
    <div class="list_tournois_content">
		<h1 class = "title">Liste des Tournois</h1>
		<div class ="lesTournois">
			<?php 
			$compteur = 0;
			while($donnees = $tournaments->fetch_array()){
				?> 
			 
				<div <?php echo ($compteur % 2==0 ? 'class=unTournoisRed' : 'class=unTournois'); ?>>
					<form id="form_tournament" method='POST'>
						<p>
						<?php echo $donnees['nom_t']?>
						</p>													
						<button type="submit" name="action" value="one_tournament">		
								Détails
						</button>
					</form>

					<form id="form_tournament_delete" method='POST'>
						<button type="submit" name="action" value="delete_tournament">		
								Supprimer
						</button>
					</form>
					<p>
					</p>
					</div>
				
			<?php 
		$compteur = $compteur + 1;} ?>
		</div>

	</div>  

<?php $content = ob_get_clean(); // Get the html content into the content var ?>
<?php require("template.php"); ?>

