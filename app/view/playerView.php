<?php ob_start(); // Initialize content start ?>


    <!-- Content goes here -->

    <ul>
    <?php

        // Afficher chaque exemple, la variable $examples
        // est définie dans le controlleur exampleController
        foreach($players as $player){
            ?>

            <li><?= $player["nom_j"] ?> <?= $player["prenom_j"] ?></li>

            <?php
        }

    ?>
    </ul>

    <!-- End of content -->

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>