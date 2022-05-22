<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->
<?php 
    $title = 'Gestion Tournoi';  // Set the page Title
    $style = "tournamentTree.css"; // Set the corresponding stylesheet
?>

<?php ob_start(); // Initialize content start ?>

<div class="tree">
    
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
        
    else if($tournament["capacite_t"] == 4){
        $rounds = 4;
        $round_labels = ["1er tour", "Quarts de Finale" ,"Semie-Finales", "Finale"];
        $match_labels = ["Rencontre", "Quart de Finale" ,"Semie-Finale", "Finale"];
    }
        

    $roundsMatches_arr = [];
    for($i = 0; $i < $rounds; $i++){
        if($i == 0)
            $roundsMatches_arr[$i] = array_filter($matches, function($v, $k){
                global $i;
                if($v["tour_r"] == 1)
                    return true;
                else
                    return false;
            }, ARRAY_FILTER_USE_BOTH);
        else{
            $roundsMatches_arr[$i] = [];
            for($j = 0; $j < $tournament["capacite_t"] / pow(2, $i + 1); $j++){
                $roundsMatches_arr[$i][] = [];
            }
        }
    }


    for($i = 0; $i < $rounds; $i++){
        ?>
        <div class="round">
            <p class="round-label"><?= $round_labels[$i] ?></p>
            <div class="round-matches" style="height:<?= $tournament["capacite_t"] * 70 ?>px">
            <?php
            foreach($roundsMatches_arr[$i] as $k => $match){
                ?>
                <form action="<?="index.php?action=updateTournamentMatch&id_t=".$tournament["id_t"]."&id_r=".$match["id_r"] ?>" method="post" class="match">
                    
                        <div class="match-label"><?= $match_labels[$i] == "Finale" ? $match_labels[$i] : $match_labels[$i] . " " . ($k + 1) ?> <input type="submit" ></div>
                        <div class="match-teams">
                            <div class="match-team"><?= isset($match["nom_e1"]) ? $match["nom_e1"] : "Gagnant " . $match_labels[$i - 1] . " " . (($k) * 2 + 1 ) ?>
                            <?php
                                if(isset($match["score_e1_r"])){
                                    ?>
                                    <span class="team-score"><input min="0" name="match['<?= $match["id_e1"] ?>'][]" type="number" width="10" value="<?= $match["score_e1_r"] ?>"></span>
                                    <?php
                                }
                            ?>
                            </div>
                            <div class="match-team"><?= isset($match["nom_e2"]) ? $match["nom_e2"] : "Gagnant " . $match_labels[$i - 1] . " " . (($k) * 2 + 2 ) ?>
                            <?php
                                if(isset($match["score_e2_r"])){
                                    ?>
                                    <span class="team-score"> <span class="team-score"><input min="0" name="match['<?= $match["id_e2"] ?>'][]" type="number" width="10" value="<?= $match["score_e2_r"] ?>"></span></span>
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

<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>