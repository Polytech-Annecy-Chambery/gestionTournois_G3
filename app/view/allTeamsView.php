<!-- Voir toutes les équipes
Voir le nombre de joueurs par équipe
Supprimer des équipes d'un simple click
Quand on clique sur l'équipe -> uneEquipe.php -->



<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->

<?php
$title = '';  // Set the page Title
$style = "example.css"; // Set the corresponding stylesheet
?>

<?php ob_start(); // Initialize content start ?>

<!-- Content goes here -->

<h2>Équipes inscrites : </h2>

<!-- Afficher l'exemple $example définie dans le controller -->
<p ><ul><?php
        while ($row = mysqli_fetch_assoc($teams)) { 
            $id_e = $row['id_e'];
            $nom_e = $row['nom_e'];
        ?>
        <li>
        <form method="post">
            <input type="hidden" name="nom_t" value="<?php echo $id_e?>">	
			<?php echo $nom_e ?>													
			<button type="submit" name="action" value="one_team">		
				Détails
			</button>
        </form>
        </li>
        <?php
        }
        ?>
        </ul>
</p>


<!-- End of content -->

<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>