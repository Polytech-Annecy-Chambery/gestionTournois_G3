<?php


    require_once("model/matchModel.php");
    require_once("model/tournamentModel.php");

    class MatchController{

        private $matchModel;
        private $tournamentModel;
        
        public function __construct()
        {
            $this->matchModel = new MatchModel();
            $this->tournamentModel = new TournamentModel();
        }


        function updateAndCreateMatch($tournamentID, $matchID){

            $teams = [];
            foreach($_POST["match"] as $k => $v){
                $teams[] = [$k, $v[0]];

            }

            $match = $this->matchModel->getMatchFromID($matchID)[0];
            $tournament = $this->tournamentModel->getTournament($tournamentID)->fetch_all(MYSQLI_ASSOC)[0];
            if($match["tour_r"] < ($tournament["capacite_t"] / 4 + 1)){


                $groupMatch = $this->matchModel->getMatchFromID($_POST["groupMatch"])[0];

                

                if($teams[0][1] > $teams[1][1])
                    $winningTeam = $teams[0][0];
                else 
                    $winningTeam = $teams[1][0];

                if($groupMatch["score_e1_r"] > $groupMatch["score_e2_r"])
                    $winningGroupTeam = $groupMatch["id_e1"];
                else 
                    $winningGroupTeam = $groupMatch["id_e2"];


                $winningTeam = intval(trim($winningTeam, "'"));

                
                $next_matchs = $this->matchModel->getMatchsFromTournamentIDAndTeamIDAndRound($tournamentID, $winningGroupTeam, $match["tour_r"] + 1);


                $numTeam = $_POST["numMatch"] % 2 == 0 ? "id_e2" : "id_e1";

                if(empty($next_matchs)){
                    
                    $this->matchModel->createNextMatch($winningTeam, $tournamentID, $match["tour_r"] + 1, $numTeam);
                }
                else{
                    $next_match = $next_matchs[0];
                    //TO DO : UPDATE NEXT MATCH
                    $this->matchModel->updateNextmatch($next_match["id_r"], $numTeam , $winningTeam );
                }

            }
            

            $this->matchModel->updateMatchScore($matchID, $teams[0][1], $teams[1][1]);
            //$this->matchModel->createMatch($tournamentID, $teams[0], $teams[1]);


            echo
            '<body onload="document.redirectform.submit()">   
                <form method="POST" action="" name="redirectform" style="display:none">
                <input name="action" value="tournamentTree">
                <input name="nom_t" value="' . $tournament["nom_t"]. '">
                </form>
            </body>';
            
        }
    }
?>