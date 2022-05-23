<?php


    require_once("model/tournamentModel.php"); // Import the example Model
    require_once("model/TeamModel.php");

    class TournamentController {

        private $tournamentModel;
        private $teamModel;
        
        function __construct(){
            $this->tournamentModel = new TournamentModel;
            $this->teamModel = new TeamModel;
        }


        // function postTournament(){

        //     // Effectuer ici tous les traitements et vérifications des données nécessaires
            

        //     // Ajouter l'example à la bdd avec le modele
        //     $this->tournamentModel->addTournament();

        //     //header(location = ....);
        // }

        function displayCreationTournament(){
            $teams = $this->teamModel->getAllTeams();
            include("view/tournamentView.php");
        }

         

    }
?>