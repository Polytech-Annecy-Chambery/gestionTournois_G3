

<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->

<?php 
    $title = 'Tous les Exemples';  // Set the page Title
    $style = "allExamples.css"; // Set the corresponding stylesheet
?>

<?php ob_start(); // Initialize content start ?>


    <!-- Content goes here -->

    <h1>Tous les Exemples</h1>
    <p>Tah l'exemple de malade</p>

    <ul>
    <?php

        // Afficher chaque exemple, la variable $examples
        // est définie dans le controlleur exampleController
        foreach($examples as $example){
            ?>

            <li><?= $example["exampleID"] ?> <?= $example["exampleName"] ?></li>

            <?php
        }

    ?>
    </ul>

    <!-- End of content -->

<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>