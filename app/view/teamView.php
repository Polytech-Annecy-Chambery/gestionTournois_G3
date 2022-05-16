<!-- Voir les joueurs de l'équipe

Ajouter un joueur

Modifier un joueur

supprimer un joueur

Modifier le nom de l'équipe

Supprimer l'équipe

Et truc en plus : voir les match joués  -->


<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->

<?php
$title = "Equipe "+ $team['nom_e'];  // Set the page Title
$style = "team.css"; // Set the corresponding stylesheet
?>

<?php ob_start(); // Initialize content start ?>

<!-- Content goes here -->

<h1>Un Exemple</h1>
<p>Tah l'exemple de malade</p>

<!-- Afficher l'exemple $example définie dans le controller -->
<p ><?= $example["exampleID"] ?> <?= $example["exampleName"] ?></p>


<!-- End of content -->

<?php $content = ob_get_clean(); // Get the html content into the content var ?>

