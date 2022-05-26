<?php


    require_once("model/matchModel.php");

    class MatchController{

        private $matchModel;
        
        public function __construct()
        {
            $this->matchModel = new MatchModel();
        }


        function updateAndCreateMatch($tournamentID, $matchID){

            $winningTeam = 0;

            $teams = [];
            foreach($_POST["match"] as $k => $v){
                $teams[] = [$k, $v[0]];

            }

            $match = $this->matchModel->getMatchFromID($matchID);

            echo print_r($_POST);

            if($teams[0][1] > $teams[1][1])
                $winningTeam = $teams[0][0];
            else 
                $winningTeam = $teams[1][0];

            $winningTeam = intval(trim($winningTeam, "'"));
            
            $next_matchs = $this->matchModel->getMatchsFromTournamentIDAndTeamIDAndRound($tournamentID, $winningTeam, $match[0]["tour_r"] + 1);

            echo print_r($next_matchs);

            if(empty($next_matchs)){
                $numTeam = $_POST["numMatch"] % 2 == 0 ? "id_e2" : "id_e1";
                $this->matchModel->createNextMatch($winningTeam, $tournamentID, $match[0]["tour_r"] + 1, $numTeam);
            }
            else{
                $next_match = $next_matchs[0];
                //TO DO : UPDATE NEXT MATCH
            }

    
            

            $this->matchModel->updateMatchScore($matchID, $teams[0][1], $teams[1][1]);
            //$this->matchModel->createMatch($tournamentID, $teams[0], $teams[1]);

        }
    }
?>