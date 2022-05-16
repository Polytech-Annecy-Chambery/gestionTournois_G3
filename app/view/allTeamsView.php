<!-- Voir toutes les équipes
Voir le nombre de joueurs par équipe
Supprimer des équipes d'un simple click
Quand on clique sur l'équipe -> uneEquipe.php -->



<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->

<?php
$title = '';  // Set the page Title
$style = "example.css"; // Set the corresponding stylesheet
?>

<?php ob_start(); // Initialize content start ?>

<!-- Content goes here -->

<h1>Équipes inscrites : </h1>

<!-- Afficher l'exemple $example définie dans le controller -->
<p ><?php
        while ($row = mysqli_fetch_assoc($teams)) { //on extrait les citoyens
            $id_e = $row['id_e'];
            $nom_e = $row['nom_e'];
            echo "<li>".$nom_e."</li>\n"."<a href=\"index.php?action=displayTeamMatch&id=$id_e\">voir les matchs</a>";
        };
    ?>
</p>


<!-- End of content -->

<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>