<?php


    require_once("model/tournamentModel.php"); // Import the example Model

    class TournamentController{

        private $tournamentModel;
        private $teamModel;
        private $matchModel;

        function __construct(){
            $this->tournamentModel = new TournamentModel();
            $this->teamModel = new TeamModel();
            $this->matchModel = new MatchModel();
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

                $data = $this->tournamentModel->getTournamentID();
                $id_t = $data->fetch_array()["id_t"];
                $teams2add = $this->teamModel->getTeams2Add($id_t);
                $teams = $this->teamModel->getAllTeamsFromTournament();
                
                require("view/OneTournament.php");
            }
        }

        function displayOneTournament(){
            $tournament = $_POST["nom_t"];
            $capacity = $_POST["capacite_t"];
            $sport = $_POST["sport_t"];
            $data = $this->tournamentModel->getTournamentID();
            $id_t = $data->fetch_array()["id_t"];
            $teams2add = $this->teamModel->getTeams2Add($id_t);

            $teams = $this->teamModel->getAllTeamsFromTournament();;
            require("view/OneTournament.php");
        }

        function deleteTournament(){
            $this->tournamentModel->deleteTournament();
            $tournaments = $this->tournamentModel->getAllTournament();
            require("view/allTournaments.php");
        }

        function retireTeam(){
        

            $tournament = $_POST["nom_t"];
            $capacity = $_POST["capacite_t"];
            $sport = $_POST["sport_t"];
            $data = $this->tournamentModel->getTournamentID();
            $id_t = $data->fetch_array()["id_t"];


            $this->teamModel->retireTeam($id_t);
            
            $teams2add = $this->teamModel->getTeams2Add($id_t);
            $teams = $this->teamModel->getAllTeamsFromTournament();
            require("view/OneTournament.php");
    
        }

        function addTeam2Tournament(){

            $tournament = $_POST["nom_t"];
            $capacity = $_POST["capacite_t"];
            $sport = $_POST["sport_t"];
            $data = $this->tournamentModel->getTournamentID();
            $id_t = $data->fetch_array()["id_t"];
            

            $this->teamModel->addTeam2Tournament($id_t);
            
            $teams2add = $this->teamModel->getTeams2Add($id_t);
            $teams = $this->teamModel->getAllTeamsFromTournament();
            require("view/OneTournament.php");

        }

        function displayTournamentTree($tournamentName){
            $id = $this->tournamentModel->getTournamentID();
            $tournamentId = $id->fetch_array()["id_t"];
            $tournament = $this->tournamentModel->getTournament($tournamentId)->fetch_array();
            $matches = $this->matchModel->getMatchsFromTournamentID($tournamentId);

            require("view/tournamentTreeView.php");
        }

    }
?>