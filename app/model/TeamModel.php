<?php
// /!\ Le modèle n'est jamais appelée ailleur que dans le controller correspondant /!\

require_once("model/model.php"); // Import the Model Class

class TeamModel extends Model {

    function getTeam( $teamID ){
        $conn = $this->dbConnect();
        $sql = "SELECT id_e,nom_e FROM equipe WHERE id_e=$teamID";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error($conn)."\n".$sql);
        return $result;
    }

    function getAllTeams(){
        $conn = $this->dbConnect();
        $sql = "SELECT id_e,nom_e FROM equipe";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error($conn)."\n".$sql);
        return $result;
    }

    function addTeams($nom){
        $conn = $this->dbConnect();
        $sql = "INSERT INTO equipe(nom_e) VALUES ($nom)";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error($conn)."\n".$sql);
    }

    function addTeam(){
        $sql = "insert into equipe(nom_e) values('".$_POST["nom_e"]."')";
        $result = mysqli_query($this->dbConnect(), $sql);
        return $result;
    }

    function existTeam(){
        $conn = $this->dbConnect();
        $result = mysqli_query($conn, "SELECT * FROM equipe WHERE equipe.nom_e='".$_POST["nom_e"]."'");
        $donnees=$result->fetch_assoc();
        
        if(is_null($donnees)==FALSE){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    function getAllTeamsFromTournament(){
        $conn = $this->dbConnect();
        $sql = "SELECT equipe.id_e,nom_e FROM equipe, tournois, appartient WHERE equipe.id_e=appartient.id_e AND appartient.id_t=tournois.id_t AND tournois.nom_t='".$_POST["nom_t"]."'";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error($conn)."\n".$sql);
        return $result;
    }
}


?>