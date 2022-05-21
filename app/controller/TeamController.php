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
        if($this->teamModel->existTeam()){
            $erreurAjout=TRUE;
            require("view/addTeam.php");
        }
        else{
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
    }

    function displayTeamInfos()
    {
        $team = $_POST["nom_e"];
        $matches = $this->teamModel->getTeamMatches();
        $players = $this->teamModel->getTeamPlayers();
        require("view/teamView.php");
    }


}