<?php
    // /!\ Le modèle n'est jamais appelée ailleur que dans le controller correspondant /!\

    require_once("model/Model.php"); // Import the Model Class

    class CreateTeamModel extends Model {

        // Dans chaque fonction, on pense bien à 
        // appeler la méthode dbConnect héritée de
        // la classe Modele

        function getIDTeam( $nom ){

            $sql = "select id_e from equipe where nom_e like".$nom;
            $result = mysqli_query($this->dbConnect(), $sql);
            return $result;

        }

        function addTeam($nom){

            $sql = "insert into equipe(nom_e) values('".$nom."')";
            $result = mysqli_query($this->dbConnect(), $sql);
            return $result;

        }

    }


?>