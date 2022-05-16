<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
</head>

<content>

    <?php require("Views/header.php"); ?>

    <body>
        <h1>Tous les tournois créés</h1>

        <ul>
            <?php while($donnees = $tournaments->fetch_array()){ ?>
                
                <li>
                    <form id="form_tournament" method='POST'>
                        <input type="hidden" name="tournament" value="<?php echo $donnees['nom_t'] ?>">
                        <?php echo  $donnees['nom_t'] ?> (<?php echo  $donnees['sport_t'] ?>)
                        <button type="submit" name="action" value="un_film">
                            Détails
                        </button>
                    </form>
                </li>      
            <?php } ?>     
        </ul>


    </body>
</content>