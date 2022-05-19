<?php


    require_once("model/matchModel.php");

    class MatchController{

        private $matchModel;
        
        public function __construct()
        {
            $this->matchModel = new MatchModel();
        }


        function updateAndCreateMatch($tournamentID, $matchID){

            echo print_r($_POST);
            echo $_POST["match"][0];
            //$this->matchModel->updateMatchScore($matchID, $_POST["match"][0], $_POST["match"][1]);
            $teams = [];
            foreach($_POST["match"] as $k => $v){
                $teams[] = [$k, $v];
            }
            $this->matchModel->createMatch($tournamentID, $teams[0], $teams[1]);

        }
    }
?>