<!-- Page de Bienvenue

Liste des tournois (différente couleur s'ils sont complet ou incomplet )

Bouton pour voir toutes les équipes

Formulaire ajouter un tournois -->

<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->

<?php $title = 'Gestion Tournois';  // Set the page Title?>

<?php ob_start(); // Initialize content start ?>

<content>
    <div id='ajoutTournois'>
			<h2>Ajouter un Tournoi :</h2>

			<form method='post' >

				<div>
					<div>
						<label for="nom_t">Nom :</label>
					</div>
					<div>
						<input id="nom_t" type="text" name="nom_t" placeholder="Nom du tournois" title="Entrez un nom de tournoi. Champ obligatoire" required>
					</div>
				</div>

                <div>
					<div>
						<label for="sport_t">Sport :</label>
					</div>
					<div>
						<input id="sport_t" type="text" name="sport_t" placeholder="Sport" title="Entrez un sport. Champ obligatoire" required>
					</div>
				</div>
				
				<label for="capacity-select">Capacité :</label>
				<select name="capacite_t" id="capacite_t">
    			<option value="">--Choisissez une capacité--</option>
				<option value="4">4</option>
				<option value="8">8</option>
				<option value="16">16</option>
				</select>
				
				<div>
					<button  type="submit" name="action" value="addTournament">Ajouter un tournoi</button>
				</div>
			</form>

			<?php 
				if(isset($erreurAjout)){
					if($erreurAjout){
						echo "Un tournoi avec le même nom existe déjà";
					}
				}
			?>

	</div>



</content>
<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>

