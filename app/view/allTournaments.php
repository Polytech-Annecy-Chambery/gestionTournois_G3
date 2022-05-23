<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
</head>

<content>
<?php $content = ob_get_clean(); // Get the html content into the content var ?>
<?php require("view/template.php"); ?>


    <body>
    <div id="Tournois existants">
		<h2>Tournois déjà créés :</h2>
		<ul>
			<?php while($donnees = $tournaments->fetch_array()){?> 
				<li>
					<form id="form_tournament" method='POST'>
						<input type="hidden" name="nom_t" value="<?php echo $donnees['nom_t']?>">	
                        <input type="hidden" name="capacite_t" value="<?php echo $donnees['capacite_t']?>">	
                        <input type="hidden" name="sport_t" value="<?php echo $donnees['sport_t']?>">	
						<?php echo $donnees['nom_t'] // CSS pour afficher en differentes couleurs les tournois pleins ou pas?>													
						<button type="submit" name="action" value="one_tournament">		
								Détails
						</button>
					</form>

					<form id="form_tournament_delete" method='POST'>
						<input type="hidden" name="nom_t" value="<?php echo $donnees['nom_t']?>">	
						<button type="submit" name="action" value="delete_tournament">		
								Supprimer
						</button>
					</form>
				</li>
			<?php } ?>
		</ul>

	</div>  

<<<<<<< HEAD


    </body>
</content>
=======
</content>

<?php $content = ob_get_clean(); // Get the html content into the content var ?>
<?php require("view/template.php"); ?>


   
>>>>>>> 2a62c3886486fe838f42af54810981fb407a8712
