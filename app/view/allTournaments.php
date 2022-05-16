<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
</head>

<content>
<?php $content = ob_get_clean(); // Get the html content into the content var ?>
<?php require("view/template.php"); ?>


    <body>
        <h1>Tous les tournois créés</h1>


            <?php while($donnees = $tournaments->fetch_array()){ ?>
                

                    <form id="form_tournament" method='GET'>
                        <input type="hidden" name="tournament" value="<?php echo $donnees['nom_t'] ?>">
                        
                        <button type="submit" name="action" value="un_film">
                            <?php echo  $donnees['nom_t'] ?> (<?php echo  $donnees['sport_t'] ?>)
                        </button>
                    </form>
            <?php } ?>     



    </body>
</content>