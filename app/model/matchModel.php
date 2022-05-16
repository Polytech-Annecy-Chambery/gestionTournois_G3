<?php
    // /!\ Le modèle n'est jamais appelée ailleur que dans le controller correspondant /!\

    require_once("model/model.php"); // Import the Model Class

    class MatchModel extends Model {

        // Dans chaque fonction, on pense bien à 
        // appeler la méthode dbConnect héritée de
        // la classe Modele

        
        function getMatchsFromTournamentID($tournamentID){
            $conn = $this->dbConnect();

            $results = mysqli_query($conn, "SELECT * from rencontre r join tournois t on t.id_t == r.id_t WHERE t.id_t =".$tournamentID);
            return $results

        }



    }


?>




