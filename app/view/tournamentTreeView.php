<?php 
    $title = 'Arbre du tournoi';
    $style = "tournamentTree.css";
    ob_start();
?>

<p class="attention">Attention à bien remplir les rencontres dans l'ordre (toutes les rencontres du 1er tour puis le tour suivant)</p>


<div class="tree

        <?php

        if($tournament["capacite_t"] ==4){
            echo " tree4";
        }

        else if($tournament["capacite_t"] ==8){
            echo " tree8";
        }

        else if($tournament["capacite_t"] ==16){
            echo " tree16";
        }
        ?>


        ">

    <?php
    $rounds = 0;
    $round_labels = [];
    $match_labels = [];

    if($tournament["capacite_t"] == 4){
        $rounds = 2;
        $round_labels = ["1er tour", "Finale"];
        $match_labels = ["Rencontre", "Finale"];
    }
        
    else if($tournament["capacite_t"] == 8){
        $rounds = 3;
        $round_labels = ["1er tour", "Semie-Finales", "Finale"];
        $match_labels = ["Rencontre", "Semie-Finale", "Finale"];
    }
        
    else if($tournament["capacite_t"] == 16){
        $rounds = 4;
        $round_labels = ["1er tour", "Quarts de Finale" ,"Semie-Finales", "Finale"];
        $match_labels = ["Rencontre", "Quart de Finale" ,"Semie-Finale", "Finale"];
    }
        

    $roundsMatches_arr = [];

    for($i = 0; $i < $rounds; $i++){
        
    
        $found_matches = array_filter($matches, function($v, $k) use ($i){

            if($v["tour_r"] == ($i + 1)){
                return true;
            }  
            else
                return false;
        }, ARRAY_FILTER_USE_BOTH);

        

        $roundsMatches_arr[$i] = $found_matches;

        while(count($roundsMatches_arr[$i]) < $tournament["capacite_t"] / pow(2, $i + 1) ){
            $roundsMatches_arr[$i][] = [];
        }

        $roundsMatches_arr[$i] = array_values($roundsMatches_arr[$i]);

    }



    for($i = 0; $i < $rounds; $i++){
        ?>
        <div class="round" >
            <p class="round-label"><?= $round_labels[$i] ?></p>
            <div class="round-matches" style="height:<?= $tournament["capacite_t"] * 80 ?>px">
            <?php
            foreach($roundsMatches_arr[$i] as $k => $match){
                ?>
                
                <form method="post" class="match">
                    
                        <input name="id_t" type="hidden" value=<?= $tournament["id_t"] ?>>
                        <input name="numMatch" type="hidden" value=<?= $k + 1?>>

                        <?php 
                            $groupMatch = NULL;
                            if(isset($match["tour_r"]) && $match["tour_r"] < $rounds){
                                    if (($k + 1 ) % 2 != 0){
                                        if(isset($roundsMatches_arr[$i][$k + 1]["id_r"]))
                                        $groupMatch = $roundsMatches_arr[$i][$k + 1]["id_r"];
                                    }
                                       
                                    else{

                                        if(isset($roundsMatches_arr[$i][$k - 1 ]["id_r"])){
                                            $groupMatch = $roundsMatches_arr[$i][$k - 1]["id_r"];
                                        }
                                    }
                                        
                                            

                            }
                            
                        ?>

                        <input name="groupMatch" type="hidden" value=<?= $groupMatch?>>

                        <?php if(isset($match["id_r"])){ ?>
                        <input name="id_r" type="hidden" value=<?= $match["id_r"] ?>>
                        <?php }?>

                        <div class="match-label"><?= $match_labels[$i] == "Finale" ? $match_labels[$i] : $match_labels[$i] . " " . ($k + 1) ?> 
                        

                        <?php if(isset($match["id_r"]) && !$match["isDone"] && isset($match["id_e1"]) && isset($match["id_e2"])){ ?>
                            <button type="submit" name="action" value="updateTournamentMatch" >Update</button>
                        <?php }?>
                        
                    
                        </div>
                        <div class="match-teams">
                            <div class='match-team<?= isset($match["nom_e1"]) ? "'><p class='nomEquipe'>".$match["nom_e1"] : " no-team'>Gagnant " . $match_labels[$i - 1] . " " . (($k) * 2 + 1 ) ?>
                            <?php
                                if(isset($match["score_e1_r"])){
                                    ?>
                                    </p><span class="team-score <?php if($match["score_e1_r"] > $match["score_e2_r"]) echo "won"; ?>"><input min="0" name="match['<?= $match["id_e1"] ?>'][]" type="number" width="10" value="<?= $match["score_e1_r"] ?>"></span>
                                    <?php
                                }
                            ?>
                            </div>
                            <div class='match-team<?= isset($match["nom_e2"]) ? "'><p class='nomEquipe'>".$match["nom_e2"] : " no-team'>Gagnant " . $match_labels[$i - 1] . " " . (($k) * 2 + 2 ) ?>
                            <?php
                                if(isset($match["score_e2_r"])){
                                    ?>
                                    </p><span class="team-score <?php if($match["score_e2_r"] > $match["score_e1_r"]) echo "won-team2"; ?>"> <input min="0" name="match['<?= $match["id_e2"] ?>'][]" type="number" width="10" value="<?= $match["score_e2_r"] ?>"></span>
                                    <?php
                                }
                            ?>
                        </div>
                        </div>
                    
                    </form>
                <?php
            }
        ?>
            </div>
        </div>
        <?php
    }
    
    ?>
    
</div>


<form id="form_tournament" method='POST' class="retour">
	<input type="hidden" name="nom_t" value="<?php echo $tournament['nom_t']?>">	
    <input type="hidden" name="capacite_t" value="<?php echo $tournament['capacite_t']?>">	
    <input type="hidden" name="sport_t" value="<?php echo $tournament['sport_t']?>">													
	<button class="button_retour" type="submit" name="action" value="one_tournament">Retour</button>
</form>

<?php 
$content = ob_get_clean();
require('template.php'); 
?>