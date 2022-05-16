<?php ob_start(); // Initialize content start ?>

    <?php
        echo "<h1>Ajouter une équipe</h1>";

        if (isset($_GET["action"])){
            if ($_GET ["action"]=="Ajouter"){
                echo "<p>L’équipe a été ajoutée</p>";
            }
        }
        
    
        echo "<form method=\"get\">";
        echo "Nom d'équipe : <input type=\"text\" name=\"nom\"><br/>";
        echo "<input type=\"submit\" name=\"action\" value=\"Ajouter\" />";
        echo "</form>";

    ?>


<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>