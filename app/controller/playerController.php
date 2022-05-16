<?php
    require_once("model/PlayerModel.php"); // Import the example Model
    
    class PlayerController{

        private $playerModel; // Bien définir le modèle correspondant

        function __construct(){
            $this->playerModel = new PlayerModel();
        }

        // https://tp-epua.univ-savoie.fr/~faskar/gestionTournois_G3/app/index.php?action=displayPlayer&id=1
        function displayPlayer($ID){

            // Récupérer l'exemple définie par le paramètre avec notre modele
            $player = $this->playerModel->getPlayer($ID);

            // Afficher la vue correspondante :

            // ATTENTION : vérifier à bien faire correspondre les variables
            // dans la vue et dans le controller : ici exampleView attend une
            // variable nommée $example
            require("view/playerView.php");

        }

        function displayAllPlayers(){

            // Récupérer l'exemple définie par le paramètre avec notre modele
            $players = $this->playerModel->getAllPlayers();

            // Afficher la vue correspondante :

            // ATTENTION : vérifier à bien faire correspondre les variables
            // dans la vue et dans le controller : ici exampleView attend une
            // variable nommée $example
            require("view/playerView.php");
        
            }
        
        function postPlayer($exampleID, $exampleName){
        
            //         // Effectuer ici tous les traitements et vérifications des données nécessaires
                    
        
            //         // Ajouter l'example à la bdd avec le modele
            //         $this->exampleModel->addExample($exampleID, $exampleName);
        
        }
    }