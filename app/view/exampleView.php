

<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->

<?php 
    $title = 'Un exemple';  // Set the page Title
    $style = "example.css"; // Set the corresponding stylesheet
?>

<?php ob_start(); // Initialize content start ?>

    <!-- Content goes here -->

    <h1>Un Exemple</h1>
    <p>Tah l'exemple de malade</p>

    <!-- Afficher l'exemple $example définie dans le controller -->
    <p ><?= $example["exampleID"] ?> <?= $example["exampleName"] ?></p>


    <!-- End of content -->

<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>