<?php

    // Classe Model qui définie les fonctions communes à tous les modèles

    class Model {

        protected function dbConnect(){
            // Connexion à la base de données sur le serveur tp-epua
            // variable $conn peut être utilisée dans tout le code
            $conn = mysqli_connect("tp-epua:3308", "orsete", "d3imtm9m") or die("Impossible de se connecter : ". mysqli_connect_error());
            //$conn = mysqli_connect("tp-epua:3308", "takahasv", "7aj9e1qe") or die("Impossible de se connecter : ". mysqli_connect_error());

            /*Sélection de la base de données*/
            mysqli_select_db($conn, "orsete") or die("Impossible de sélectionner la base: ". mysqli_connect_error());   
            //mysqli_select_db($conn, "takahasv") or die("Impossible de sélectionner la base: ". mysqli_connect_error());   
            
            /*Encodage UTF8 pour les échanges avec la BD*/
            mysqli_query($conn, "SET NAMES UTF8");

            return $conn;
        }

    }

?>