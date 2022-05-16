<?php


    require_once("model/tournamentModel.php"); // Import the example Model

    class TournamentController{

        private $tournamentModel;

        function __construct(){
            $this->tournamentModel = new TournamentModel();
        }
        


        function postTournament(){

            // Effectuer ici tous les traitements et vérifications des données nécessaires
            

            // Ajouter l'example à la bdd avec le modele
            $this->tournamentModel->addTournament();

            //header(location = ....);

        }

        function displayAllTournament(){

            $tournaments = $this->tournamentModel->getAllTournament();

            require("view/allTournaments.php");
        }
    }
?>