<?php


    require_once("model/tournamentModel.php"); // Import the example Model
    require_once("model/matchModel.php");

    class TournamentController{

        private $tournamentModel; // Bien définir le modèle correspondant
        private $matchModel;
        
        public function __construct()
        {
            $this->tournamentModel = new TournamentModel();
            $this->matchModel = new MatchModel();
        }

        function displayTournamentTree($tournamentId){
            $tournament = $this->tournamentModel->getTournament($tournamentId);
            $matches = $this->matchModel->getMatchsFromTournamentID($tournamentId);

            require("view/tournamentTreeView.php");
        }

        function postTournament(){

            // Effectuer ici tous les traitements et vérifications des données nécessaires
            

            // Ajouter l'example à la bdd avec le modele
            $this->tournamentModel->addTournament();

            //header(location = ....);

        }

    }
?>