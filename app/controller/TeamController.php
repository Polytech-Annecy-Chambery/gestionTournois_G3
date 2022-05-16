<?php

require_once("app/model/TeamModel.php"); // Import the example Model

class TeamController
{

    private $teamModel = new TeamModel(); // Bien définir le modèle correspondant

    function displayTeam($teamID)
    {
        $team = $this->teamModel->getTeam($teamID);
        require("app/view/teamView.php");
    }

    function displayAllTeams($teamID)
    {
        $teams = $this->teamModel->getAllTeams();
        require("app/view/teamView.php");
    }

}

