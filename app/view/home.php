<!-- Page de Bienvenue

Liste des tournois (différente couleur s'ils sont complet ou incomplet )

Bouton pour voir toutes les équipes

Formulaire ajouter un tournois -->

<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->

<?php $title = 'Gestion Tournois';  // Set the page Title?>

<?php ob_start(); // Initialize content start ?>

	<div class="buttons">
	<a href="index.php?action=addTournament"><input class="button"
       type="button"
       value="Ajouter un tournoi"></a>

	   <a href="index.php?action=addTeam"><input class="button"
       type="button"
       value="Ajouter une équipe">
	</div>


    <!-- <div id='addTournament'>
			<h2>Ajouter un Tournois :</h2>

			<form method='post' action='index.php?action=postTournament'>

				<div>
					<div>
						<label for="nom_t">Nom :</label>
					</div>
					<div>
						<input id="nom_t" type="text" name="nom_t" placeholder="Nom du tournois" title="Entrez un nom de tounrois. Champ obligatoire" required>
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

				
				<div>
					<input  type="submit" 
							name="action" 
							value="Ajouter">
				</div>
			</form>
		</div> -->

<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>