<?php
$title = 'Voir toutes les équipes';
$style = "allView.css";
ob_start();
?>

<div id="list_equipes_content">
    <h1 class = "title">Équipes inscrites</h1>

    <?php  
    if(isset($erreurDelete)){
                    if($erreurDelete == TRUE ){
                        echo "<p class='error'>Impossible. L'équipe est déjà dans un tournoi.</p>";
                    }
                }
    ?>

    <div class = "lesEquipes">
        <?php
            $compteur = 0;
            while ($row = mysqli_fetch_assoc($teams)) { 
                $id_e = $row['id_e'];
                $nom_e = $row['nom_e'];
        ?>

        <div <?php echo ($compteur % 2==0 ? 'class=uneEquipe' : 'class=uneEquipeGrey'); ?>>
            
            <div class="nom"><?php echo $nom_e ?></div>

            <div class="form_contain">
                <form id="form_team" method="post">
                    <input type="hidden" name="nom_e" value="<?php echo $nom_e?>">														
                    <button class="button" type="submit" name="action" value="one_team">Détails</button>
                </form>

                <form id="form_team_delete" method='POST'>
                    <input type="hidden" name="nom_e" value="<?php echo $nom_e ?>">	
                    <input type="hidden" name="id_e" value="<?php echo $id_e ?>">	
                    <button class="button" type="submit" name="action" value="delete_team">Supprimer</button>
                </form>
            </div>
            
            

        </div>

        <?php
        $compteur = $compteur + 1;}
        ?>


    <p>
		<?php 
			// if(isset($erreurDelete)){
			// 	if($erreurDelete){
			// 		echo "Impossible. Cette équipe est déjà dans un tournoi.";
			// 	}
			// }
		?>
	</p>
            
    </div>

    <form method="post">
		<button class="button_ajout" type="submit" name="action" value="page_addTeam">
			Ajouter une équipe
		</button>
	</form>


</div>

<?php 
$content = ob_get_clean();
require('template.php'); 
?>