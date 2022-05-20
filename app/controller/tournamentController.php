<?php


    require_once("model/TournamentModel.php"); // Import the example Model

    class TournamentController{

        private $tournamentModel;
        private $teamModel;

        function __construct(){
            $this->tournamentModel = new TournamentModel();
            $this->teamModel = new TeamModel();
        }
        


        function displayAddTournament(){
            require("view/addTournament.php");
        }


        function displayAllTournament(){

            $tournaments = $this->tournamentModel->getAllTournament();

            require("view/allTournaments.php");
        }

        function addTournament(){
            
            if($this->tournamentModel->existTournament()){
                $erreurAjout=TRUE;
                require("view/addTournament.php");
            }
            else{
                $this->tournamentModel->addTournament();
                $tournament = $_POST["nom_t"];
                $capacity = $_POST["capacite_t"];
                $sport = $_POST["sport_t"];
                $teams = $this->teamModel->getAllTeams();
                require("view/OneTournament.php");
            }
        }

        function displayOneTournament(){
            $tournament = $_POST["nom_t"];
            $capacity = $_POST["capacite_t"];
            $sport = $_POST["sport_t"];
            $id_t = $this->tournamentModel->getTournamentID();
            $teams = $this->teamModel->getAllTeamsFromTournament();
            $data = mysqli_fetch_array($teams);
            require("view/OneTournament.php");
        }

    }
?>