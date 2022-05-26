<?php
    require_once("model/createTeamModel.php"); // Import the example Model

    class CreateTeamController{

        private $createTeam; // Bien définir le modèle correspondant

        function __construct(){
            $this->createTeam = new CreateTeamModel();
        }

        function postTeam($nom){

            $this->createTeam->addTeam($nom);


        }
    }
?>