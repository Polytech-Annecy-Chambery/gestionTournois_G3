<?php


    require_once("model/TournamentModel.php"); // Import the example Model

    class ExampleController{

        private $tournamentModel = new ExampleModel(); // Bien définir le modèle correspondant


        function postTournament(){

            // Effectuer ici tous les traitements et vérifications des données nécessaires
            

            // Ajouter l'example à la bdd avec le modele
            $this->tournamentModel->addTournament();

            //header(location = ....);

        }
    }
?>