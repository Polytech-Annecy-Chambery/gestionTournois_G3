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

         while($row = $teams->fetch_array()){ { 
                $nom_e = $row["nom_e"];
            ?>
            <li>
            <form method="post">
                <input type="hidden" name="nom_e" value="<?php echo $nom_e?>">	
                <?php echo $nom_e ?>													
                <button type="submit" name="action" value="one_team">		
                    Détails
                </button>
            </form>
            </li>
            <?php
            }
        }
        ?>
        </ul>
    </div>

        








	</div>  





    </body>
</content>