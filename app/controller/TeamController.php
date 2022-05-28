<?php

require_once("model/TeamModel.php"); // Import the example Model
require_once("model/matchModel.php");

class TeamController
{

    private $teamModel;
    private $matchModel;

    function __construct(){
        $this->teamModel = new TeamModel();
        $this->matchModel = new MatchModel(); // Bien définir le modèle correspondant

    } 
    function displayTeam($teamID)
    {
        $team = $this->teamModel->getTeam($teamID);
        require("view/teamView.php");
    }

    function displayAllTeams()
    {
        $teams = $this->teamModel->getAllTeams();
        require("view/allTeamsView.php");
    }

    function displayAddTeam(){
        require("view/addTeam.php");
    }

    function addTeam(){
        $erreurAjout=FALSE;
        $erreurAjout2=FALSE;
        $erreurAjout3=FALSE;

        if($this->teamModel->existTeam()){
            $erreurAjout=TRUE;
            require("view/addTeam.php");
        }
        else if($_POST["nom_e"]==null){
            $erreurAjout2=TRUE;
            require("view/addTeam.php");

        }
        else if(strlen($_POST["nom_e"])>50){
            $erreurAjout3=TRUE;
            require("view/addTeam.php");

        }
        else if($erreurAjout=FALSE && $erreurAjout2=FALSE && $erreurAjout3=FALSE){
            $this->teamModel->addTeam();
            $teams = $this->teamModel->getAllTeams();
            require("view/allTeamsView.php");
        }
        
    }

    function deleteTeam(){

        $this->teamModel->deleteTeam();
        //$this->matchModel->deleteMatchs();
        //Supprimer les matchs quand on aura ajouté la gestion des matchs
        $teams = $this->teamModel->getAllTeams();
        require("view/allTeamsView.php");


        // if($this->teamModel->existTeamInTournament()){
        //     $erreurDelete=TRUE;
        //     require("view/allTeamsView.php");
        // }
        // else{
        //     $this->teamModel->deleteTeam();
        //     $teams = $this->teamModel->getAllTeams();
        //     require("view/allTeamsView.php");
        // }
    }

    function displayTeamInfos()
    {
        $team = $_POST["nom_e"];
        $matches = $this->teamModel->getTeamMatches();
        $players = $this->teamModel->getTeamPlayers();
        require("view/teamView.php");
    }

    function addPlayer()
    {

        $erreurAjout=FALSE;
        $erreurAjout2=FALSE;
        $erreurAjout3=FALSE;

        $team = $_POST["nom_e"];
        $result = $this->teamModel->getTeamID($team);
        $id_t = $result->fetch_array()[0];

        if($this->teamModel->existPlayer()){
            $erreurAjout=TRUE;
           
        }
        else if($_POST["nom_j"]==null || $_POST["prenom_j"]==null){
            $erreurAjout2=TRUE;
           

        }
        else if(strlen($_POST["nom_j"])>30 || strlen($_POST["prenom_j"])>30){
            $erreurAjout3=TRUE;
            

        }
        else if($erreurAjout=FALSE && $erreurAjout2=FALSE && $erreurAjout3=FALSE){
            $this->teamModel->addPlayer($id_t);
           
        }

        $matches = $this->teamModel->getTeamMatches();
        $players = $this->teamModel->getTeamPlayers();
        require("view/teamView.php");
    }

    function deletePlayer()
    {
        $team = $_POST["nom_e"];
        $this->teamModel->removePlayer();
        $matches = $this->teamModel->getTeamMatches();
        $players = $this->teamModel->getTeamPlayers();
        require("view/teamView.php");
    }


}