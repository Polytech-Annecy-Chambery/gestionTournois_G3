<!-- Voir les joueurs de l'équipe

Ajouter un joueur

Modifier un joueur

supprimer un joueur

Modifier le nom de l'équipe

Supprimer l'équipe

Et truc en plus : voir les match joués  -->


<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        table{
            width: 50%;
        }
        table,
        td {
            text-align: center;
            border: 1px solid #333;
        }

        thead {
            background-color: brown;
            color: #fff;
        }
    </style>
</head>

<content>
<?php $content = ob_get_clean(); // Get the html content into the content var ?>
<?php require("view/template.php"); ?>


    <body>
    <div id="Equipe">
		<h2>Informations sur l'équipe: <?php echo $team ?></h2>
    </br>
        <table>
            <thead>
                <tr>
                    <th colspan="3">Matchs joués</th>
                </tr>
                <tr>
                    <th>Home Team</th>
                    <th>Score</th>
                    <th>Away Team</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $matches->fetch_assoc()) {
                    $home_team = new TeamModel();
                    $h_name = $home_team->getTeam($row["id_e1"])->fetch_array();
                    $h_name = $h_name[1];
                    $away_team = new TeamModel();
                    $a_name = $away_team->getTeam($row["id_e2"])->fetch_array();
                    $a_name = $a_name[1];
                    echo "<tr>";
                    echo "<td>".$h_name."</td>";
                    echo "<td>".$row["score_e1_r"]." - ".$row["score_e2_r"]."</td>";
                    echo "<td>".$a_name."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        </br>
        </br>
        <table>
            <thead>
                <tr>
                    <th colspan="2">Joueurs de l'équipe</th>
                </tr>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $players->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["nom_j"]."</td>";
                    echo "<td>".$row["prenom_j"]."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    </body>

</html>
        