<?php 
$title = 'Gestion Tournois';
$style = "teamView.css"; 
ob_start();

?>


<content>
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
        <table class ="tab_joueurs">
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
                    echo "<form method=\"POST\">
                        <input type=\"hidden\" name=\"nom_j\" value=\"".$row['nom_j']."\">	
                        <input type=\"hidden\" name=\"prenom_j\" value=\"".$row['prenom_j']."\">
                        <input type=\"hidden\" name=\"nom_e\" value=\"".$team."\">
                    ";
                    echo "<td> <button  type=\"submit\" name=\"action\" value=\"deletePlayer\">Supprimer</button> </td>";
                    echo "</form></tr>";
                    
                }
                ?>
            </tbody>
        </table>
        </br>
        <h2>Ajouter un joueur à l'équipe:</h2>

            <form method='post' >
	
                <div>
                    <div>
                        <label for="nom_j">Nom du joueur:</label>
                        <input id="nom_j" type="text" name="nom_j" placeholder="Entrez un nom" >
                    </div>
                    <div>
                        <label for="prenom_j">Prénom du joueur:</label>
                        <input id="prenom_j" type="text" name="prenom_j" placeholder="Entrez un prénom" >
                    </div>
                </div>
                <input type="hidden" name="nom_e" value="<?php echo $team ?>">
		</br>
                <div>
                    <button  type="submit" name="action" value="addPlayer">Ajouter le joueur</button>
                </div>
            </form>
	    </br>
            <?php 
		if(isset($erreurAjout)){
			if($erreurAjout){
				echo "Attention! Ce joueur est déjà présent dans une équipe.";
			}
		}
	    ?>

    </div>


<?php 
$content = ob_get_clean();
require('template.php'); 
?>

