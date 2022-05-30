<?php 
$title = "Gestion d'une équipe";
$style = 'teamView.css';
$content = ob_start();
?>


    <h1>Equipe : <?php echo $team ?></h1>

    <div id="equipe_content">

        <div class="matchs">

            <table>
                <thead>
                    <tr>
                        <th colspan="4">Matchs joués</th>
                    </tr>
                    <tr>
                        <th>Equipe A</th>
                        <th>Score</th>
                        <th>Equipe B</th>
                        <th>Tournoi</th>
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
                        $name_tourn = new TeamModel();
                        $t_name = $name_tourn->getTournament($row["id_t"])->fetch_array();
                        $t_name = $t_name[0];
                        echo "<tr>";
                            echo "<td>".$h_name."</td>";
                            echo "<td>".$row["score_e1_r"]." - ".$row["score_e2_r"]."</td>";
                            echo "<td>".$a_name."</td>";
                            echo "<td>".$t_name."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>

		

        
        <div class="joueurs">

            <table class ="tab_joueurs">
                <thead>
                    <tr>
                        <th colspan="3">Joueurs de l'équipe</th>
                    </tr>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <form method='post' >
                            <td>
                                <input id="nom_j" type="text" name="nom_j" placeholder="Entrez un nom" title="Entrez un sport. Champ obligatoire pour créer un nouveau joueur" maxlength="30"  required >
                            </td>

                            <td>
                                <input id="prenom_j" type="text" name="prenom_j" placeholder="Entrez un prénom" title="Entrez un sport. Champ obligatoire pour créer un nouveau joueur" maxlength="30" required >
                            </td>

                            <input type="hidden" name="nom_e" value="<?php echo $team ?>">
                            
                            <td>
                                <button class="table_button" type="submit" name="action" value="addPlayer">Ajouter</button>
                            </td>
                        </form>
                    </tr>
                    <?php
                    while ($row = $players->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["nom_j"]."</td>";
                        echo "<td>".$row["prenom_j"]."</td>";
                        echo "<form method=\"POST\">
                            <input type=\"hidden\" name=\"nom_j\" value=\"".$row["nom_j"]."\">	
                            <input type=\"hidden\" name=\"prenom_j\" value=\"".$row["prenom_j"]."\">
                            <input type=\"hidden\" name=\"nom_e\" value=\"".$team."\">
                        ";
                        echo "<td> <button class='table_button btn_suppr' type=\"submit\" name=\"action\" value=\"deletePlayer\">Supprimer</button> </td>";
                        echo "</form></tr>";
                        
                    }
                    ?>
                    
                    
                </tbody>
            </table>

            <p class='error'>
                <?php 
                if(isset($erreurAjout) && isset($erreurAjout2) && isset($erreurAjout3)){
                    if($erreurAjout == TRUE || $erreurAjout2==TRUE || $erreurAjout3==TRUE){
                        echo "Impossible. ";
        
                        if($erreurAjout == TRUE){
                            echo "Un joueur du même nom/prenom existe déjà.";
                        }
                        if($erreurAjout2 == TRUE){
                            echo "Un champs n'a pas été rempli.";
                        }
                        if($erreurAjout3 == TRUE){
                            echo "Un champs contient trop de caractères.";
                        }
                    }
                }
            ?>
	        </p>
        

        </div>
        

    </div>



<?php 
$content = ob_get_clean();
require('template.php'); 
?>

        
