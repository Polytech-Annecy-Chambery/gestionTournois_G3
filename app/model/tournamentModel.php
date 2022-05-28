<?php
    // /!\ Le modèle n'est jamais appelée ailleur que dans le controller correspondant /!\

    require_once("model.php"); // Import the Model Class

    class TournamentModel extends Model {

        // Dans chaque fonction, on pense bien à 
        // appeler la méthode dbConnect héritée de
        // la classe Modele

        function getTournament($tournamentID){
            $conn = $this->dbConnect();

            $results = mysqli_query($conn, "SELECT * from tournois WHERE id_t =".$tournamentID);
            return $results;

        }

        function getAllTournament(){
            $conn = $this->dbConnect();
            $results = mysqli_query($conn, "SELECT * from tournois");
            return $results;

        }

        
        function addTournament(){
            $conn = $this->dbConnect();
            $results = mysqli_query($conn, "INSERT INTO tournois (nom_t, capacite_t, sport_t) VALUES ('".$_POST["nom_t"]."','".$_POST["capacite_t"]."', '".$_POST["sport_t"]."')");
            return $results;


            // Code pour ajouter un exemple à la bdd
            // INSERT 

        }

        function existTournament(){
            $conn = $this->dbConnect();
            $result = mysqli_query($conn, "SELECT * FROM tournois WHERE tournois.nom_t='".$_POST["nom_t"]."'");
            $donnees=$result->fetch_assoc();
            
            if(is_null($donnees)==FALSE){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }

        function getTournamentID(){
            $conn = $this->dbConnect();
            $results = mysqli_query($conn, "SELECT id_t from tournois WHERE tournois.nom_t='".$_POST["nom_t"]."'");
            return $results;
        }

        function deleteTournament(){
            $conn = $this->dbConnect();
            $results = mysqli_query($conn, "DELETE FROM tournois WHERE tournois.nom_t='".$_POST["nom_t"]."'");
            return $results;
        }



        function startTournament($tournamentID){
            $conn = $this->dbConnect();
            $results = mysqli_query($conn, "UPDATE tournois SET started = 1 WHERE id_t = $tournamentID");
            return $results;
        }

    }


?>