<!-- Page de Bienvenue

Liste des tournois (différente couleur s'ils sont complet ou incomplet )

Bouton pour voir toutes les équipes

Formulaire ajouter un tournois -->

<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->

<?php $title = 'Gestion Tournois';  // Set the page Title?>

<?php ob_start(); // Initialize content start ?>


    <!-- Content goes here -->

    <h1>Gestion tournois</h1>
    <p>Salut</p>
    
    <!-- End of content -->

<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>