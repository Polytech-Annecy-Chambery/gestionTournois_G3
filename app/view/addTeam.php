<!-- Page de Bienvenue

Liste des tournois (différente couleur s'ils sont complet ou incomplet )

Bouton pour voir toutes les équipes

Formulaire ajouter un tournois -->

<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->

<?php $title = 'Gestion Tournois';  // Set the page Title?>

<?php ob_start(); // Initialize content start ?>

<content>
    <div id='ajoutTournois'>
			<h2>Ajouter une Equipe :</h2>

			<form method='post' >

				<div>
					<div>
						<label for="nom_e">Nom :</label>
					</div>
					<div>
						<input id="nom_e" type="text" name="nom_e" placeholder="Nom de l'équipe" title="Entrez un nom de tournoi. Champ obligatoire" required>
					</div>
				</div>
				
				<div>
					<button  type="submit" name="action" value="addTeam">Ajouter une équipe</button>
				</div>
			</form>


            <?php 
				if(isset($erreurAjout)){
					if($erreurAjout){
						echo "Une équipe avec le même nom existe déjà";
					}
				}
			?>

	</div>



</content>
<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>
