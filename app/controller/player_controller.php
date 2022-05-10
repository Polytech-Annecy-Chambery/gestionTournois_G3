<?php
    require_once("model/playerModel.php"); // Import the example Model
    
    class PlayerController{

        private $playerModel = new PlayerModel(); // Bien définir le modèle correspondant

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
    }