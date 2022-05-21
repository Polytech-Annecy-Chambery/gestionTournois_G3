<?php
    // /!\ Le modèle n'est jamais appelée ailleur que dans le controller correspondant /!\

    require_once("model/model.php"); // Import the Model Class

    class MatchModel extends Model {

        // Dans chaque fonction, on pense bien à 
        // appeler la méthode dbConnect héritée de
        // la classe Modele

        
        function getMatchsFromTournamentID($tournamentID){
            $conn = $this->dbConnect();

            $results = mysqli_query($conn, "SELECT r.id_r, r.id_e1, e1.nom_e as nom_e1, e1.id_e as id_e1, e2.id_e as id_e2, r.id_e2, e2.nom_e as nom_e2, r.score_e1_r, r.score_e2_r, r.tour_r 
            from rencontre r join tournois t on t.id_t = r.id_t 
            join equipe e1 on e1.id_e = r.id_e1 join equipe e2 on e2.id_e = r.id_e2
            WHERE t.id_t =".$tournamentID);
            return $results->fetch_all(MYSQLI_ASSOC);

        }

        function updateMatchScore($matchID, $score_e1, $score_e2){
            $conn = $this->dbConnect();

            $sql = "UPDATE rencontre 
            SET score_e1_r = ".$score_e1.", score_e2_r = ".$score_e2. ", isDone = TRUE
            WHERE id_r = ". $matchID;

            $results = mysqli_query($conn, $sql);

        }

        function createMatch($tournamentID, $team1, $team2){

            $conn = $this->dbConnect();

            $winningTeam = 0;

            if($team1[1] > $team2[1])
                $winningTeam = $team1[0];
            else 
                $winningTeam = $team2[0];

            $sql = "
            ";
        }

    }


?>






