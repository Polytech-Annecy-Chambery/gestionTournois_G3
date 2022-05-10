<?php
    // /!\ Le modèle n'est jamais appelée ailleur que dans le controller correspondant /!\

    require_once("model/model.php"); // Import the Model Class

    class playerModel extends Model {

        // Dans chaque fonction, on pense bien à 
        // appeler la méthode dbConnect héritée de
        // la classe Modele

        function getPlayer( $ID ){
            $this->dbConnect();
            $sql = "select nom_j, prenom_j from joueur where id_j = ".$ID;
            $result = mysqli_query($this->dbConnect(), $sql);
            return $result;

        }

        function getAllExamples(){
            $this->dbConnect();

            // Code pour récupérer tous les exemples

        }

        function addExample( $exampleID, $exampleName){
            $this->dbConnect();

            // Code pour ajouter un exemple à la bdd

        }

    }


?>