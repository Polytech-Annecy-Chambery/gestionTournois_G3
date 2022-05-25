<?php

require_once("model/tournamentModel.php");

Class HomeController {

    private $tournamentModel;
    
    function __construct(){
        $this->tournamentModel = new TournamentModel(); // Bien définir le modèle correspondant

    } 

    function displayHome(){
        $tournaments = $this->tournamentModel->getAllTournament();
        include("view/home.php");
        
    }

}

?>