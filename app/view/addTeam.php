<?php 
	$title = 'Ajouter une équipe';
	$style = "add.css";
	ob_start();
?>

<div id='ajoutEquipe'>
	<h1>Ajouter une Equipe</h1>

	<form class="form_content" method='post' >

		<div>
			<p>Nom de l'Equipe</p>
			<input id="nom_e" type="text" name="nom_e" placeholder="Nom de l'équipe" title="Entrez un nom de tournoi. Champ obligatoire" maxlength="50" required>
		</div>
				
		<div>
			<button class="button_ajout" type="submit" name="action" value="addTeam">Ajouter</button>
		</div>

	</form>

	<p class='error'>
		<?php
		if(isset($erreurAjout) && isset($erreurAjout2) && isset($erreurAjout3)){ 
			if($erreurAjout == TRUE || $erreurAjout2==TRUE || $erreurAjout3==TRUE){
				echo "Impossible. ";

				if($erreurAjout == TRUE){
					echo "Un tournoi du même nom existe déjà.";
				}
				if($erreurAjout2 == TRUE){
					echo "Le champs n'a pas été rempli.";
				}
				if($erreurAjout3 == TRUE){
					echo "Le champs contient trop de caractères.";
				}
			}
		}
		?>
	</p>
            

</div>

<?php 
$content = ob_get_clean();
require('template.php'); 
?>
