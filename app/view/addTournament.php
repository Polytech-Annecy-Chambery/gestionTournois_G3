<?php 
	$title = 'Ajouter un tournoi';
	$style = "add.css";
	ob_start();
?>


<div id='ajoutTournoi'>
	<h1>Ajouter un Tournoi</h1>

	<form class="form_content" method='post' >

		<div>
			<p>Nom du tounoi</p>

			<input id="nom_t" type="text" name="nom_t" placeholder="Nom du tournois" title="Entrez un nom de tournoi. Champ obligatoire" maxlength="100" required>
		</div>

        <div>
			<p>Sport</p>

			<input id="sport_t" type="text" name="sport_t" placeholder="Sport" title="Entrez un sport. Champ obligatoire" maxlength="15" required>
		</div>

		<div>
			<p>Capacité</p>

			<select name="capacite_t" id="capacite_t">
    			<option value="">--Choisissez une capacité--</option>
				<option value="4">4</option>
				<option value="8">8</option>
				<option value="16">16</option>
			</select>

		</div>
		
		<div>
			<button class="button_ajout" type="submit" name="action" value="addTournament">Ajouter</button>
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
					echo "Un champs n'a pas été rempli.";
				}
				if($erreurAjout3 == TRUE){
					echo "Un champs contient trop de caractères.";
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

