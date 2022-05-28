<?php 
$title = "Gestion d'un tournoi";
$style = "oneTournament.css";
$content = ob_start(); 
$i = $teams->num_rows;
?>

<h1><?php echo $tournament ?></h1>
<div id="unTournoi">
	

    <div id="ajoutEquipeAuTournoi">

        <h2>Tournoi de <?php echo $sport ?></h2>

        <p class ="attendu">
            Nombre d'équipes attendu : <?php echo $capacity ?>
        </p>

        <?php if( $i < (int)$capacity) { ?>

        <form method="POST">
            <input type="hidden" name="nom_t" value="<?php echo $tournament ?>">	
            <input type="hidden" name="capacite_t" value="<?php echo $capacity ?>">
            <input type="hidden" name="sport_t"	value="<?php echo $sport ?>">
            <input type="hidden" name="id_e" value="<?php echo $id_e ?>">	
            
            <div>
                <p>Ajouter une équipe au tournoi</p>
                <select name="add-team" id="add-team">
                    <option value="">--Choisissez une équipe--</option>
                    <?php
                    while($row = $teams2add->fetch_array()) { 
                        echo "<option value='".$row["id_e"]."'>".$row["nom_e"]."</option>";
                    }

                    ?>
                </select>
            </div>

            <div>
                <button class="button_ajout" type="submit" name="action" value="addTeam2Tournament">Ajouter</button>
            </div>
                
        </form>

        <?php } ?>

        <div>

            <?php if ($i == (int)$capacity){ ?>

            <form method="POST">
                <input type="hidden" name="nom_t"	 value="<?php echo $tournament ?>">	
                <button class="button_ajout" type="submit" name="action" value="tournamentTree">Afficher le tournoi</button>
            </form>

            <?php

                }
                else if($i > (int)$capacity){
                    echo "<p class='error'>Il y a trop d'équipes. Vous ne pouvez pas lancer le tournoi.</p>";
                }
                else{
                    echo "<p class='error'>Il n'y a pas assez d'équipes. Vous ne pouvez pas lancer le tournoi.</p>";
                }

            ?>

        </div>
    </div>


    <div id = "list_equipesT_content">
        <h2>Liste des équipes inscrites dans le tournoi</h2>

        <div class ="lesEquipes">
            <?php
                $compteur = 0;
                while($row = $teams->fetch_array()) { 
                    $nom_e = $row["nom_e"];
                    $id_e = $row["id_e"];
            ?>

            <div <?php echo ($compteur % 2==0 ? 'class=uneEquipe' : 'class=uneEquipeGrey'); ?>>
                <div class="nom"><?php echo $nom_e ?></div>

                <div class="form_contain">

                    <form method="post">
                        <input type="hidden" name="nom_e" value="<?php echo $nom_e?>">	

                        <button class="button" type="submit" name="action" value="one_team">Détails</button>
                    </form>

                    <form id="form_team_delete" method='POST'>
                        <input type="hidden" name="nom_t"	 value="<?php echo $tournament ?>">	
                        <input type="hidden" name="capacite_t"	 value="<?php echo $capacity ?>">
                        <input type="hidden" name="sport_t"	 value="<?php echo $sport ?>">
                        <input type="hidden" name="id_e"	 value="<?php echo $id_e ?>">	

                        <button class="button" type="submit" name="action" value="retire_team">Retirer</button>
                    </form>

                </div>
            </div>

            <?php $compteur = $compteur + 1;} ?>
        
        </div>

    </div>


</div> 

<!-- à refaire car marche pas
    <div id="deleteTournoi">
    <form id="form_tournament_delete" method='POST'>
		<input type="hidden" name="nom_t" value="<?php //echo $donnees['nom_t']?>">
		<input type="hidden" name="id_t" value="<?php //echo $donnees['id_t']?>">
		<button class="button_sup" type="submit" name="action" value="delete_tournament">Supprimer le tournoi</button>
	</form>
</div> -->


<?php 
$content = ob_get_clean();
require('template.php'); 
?>