<?php

require_once("model/TeamModel.php"); // Import the example Model

class TeamController
{

    private $teamModel;

    function __construct(){
        $this->teamModel = new TeamModel(); // Bien définir le modèle correspondant

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

}