<?php
    // /!\ Le modèle n'est jamais appelée ailleur que dans le controller correspondant /!\

    require_once("model/model.php"); // Import the Model Class

    class TournamentModel extends Model {

        // Dans chaque fonction, on pense bien à 
        // appeler la méthode dbConnect héritée de
        // la classe Modele

        function getTournament($tournamentID){
            $conn = $this->dbConnect();

            $results = mysqli_query($conn, "SELECT * from tournois WHERE id_t =".$tournamentID);
            return $results
        }



        
        function addTournament($nom,$sport,$capacite,$membres){
            $conn = $this->dbConnect();

            $results = mysqli_query($conn,);

        }

    }


?>