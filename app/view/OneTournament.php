<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
</head>

<content>
<?php $content = ob_get_clean(); // Get the html content into the content var ?>
<?php require("view/template.php"); ?>


    <body>
    <div id="Tournoi">
		<h2>Tournoi <?php echo $tournament ?></h2>
        Tournoi de : <?php echo $sport ?>
        </br>
        Il faut <?php echo $capacity ?> équipes pour lancer le tournoi.



        

        </br>
        Liste des équipes inscrites :
        </br>
        <ul>
        <?php

        $i = $teams->num_rows;

        while($row = $teams->fetch_array()) { 
                $nom_e = $row["nom_e"];
                $id_e = $row["id_e"];
            ?>
            <li>
            <form method="post">
                <input type="hidden" name="nom_e" value="<?php echo $nom_e?>">	
                <?php echo $nom_e ?>													
                <button type="submit" name="action" value="one_team">		
                    Détails
                </button>
            </form>

            <form id="form_team_delete" method='POST'>
                <input type="hidden" name="nom_t"	 value="<?php echo $tournament ?>">	
                <input type="hidden" name="capacite_t"	 value="<?php echo $capacity ?>">
                <input type="hidden" name="sport_t"	 value="<?php echo $sport ?>">
                <input type="hidden" name="id_e"	 value="<?php echo $id_e ?>">	

                <button type="submit" name="action" value="retire_team">		
                        Retirer
                </button>
            </form>

            </li>
            <?php
            }
            ?>

            </ul>
            <form method="POST">
            <input type="hidden" name="nom_t"	 value="<?php echo $tournament ?>">	
            <input type="hidden" name="capacite_t"	 value="<?php echo $capacity ?>">
            <input type="hidden" name="sport_t"	 value="<?php echo $sport ?>">
            <input type="hidden" name="id_e"	 value="<?php echo $id_e ?>">	
            <label for="add-team">Ajouter une équipe:</label>
            <select name="add-team" id="add-team">
            <option value="">--Choisissez une équipe--</option>
            <?php
            while($row = $teams2add->fetch_array()) { 
                echo "<option value='".$row["id_e"]."'>".$row["nom_e"]."</option>";
            }

            ?>
            </select>
                <button type="submit" name="action" value="addTeam2Tournament">		
                    Valider
                </button>
            </form>
            <?php


            if ($i == (int)$capacity){?>

            <form method="POST">
                <input type="hidden" name="nom_t"	 value="<?php echo $tournament ?>">	
                <button type="submit" name="action" value="tournamentTree">		
                    LANCER LE TOURNOI
                </button>
            </form>

            <?php
            
            }
            else if($i > (int)$capacity){
                echo "trop d'équipes";
            }
            else{
                echo "pas assez d'équipes";
            }
            
        ?>

    </div>

        








	</div>  





    </body>
</content>
