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

    function getTeamID( $nom_e ){
        $conn = $this->dbConnect();
        $sql = "SELECT id_e,nom_e FROM equipe WHERE nom_e='".$nom_e."'";
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

    function countAllTeamsFromTournament(){
        $conn = $this->dbConnect();
        $sql = "SELECT count(*) FROM equipe, tournois, appartient WHERE equipe.id_e=appartient.id_e AND appartient.id_t=tournois.id_t AND tournois.nom_t='".$_POST["nom_t"]."'";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error($conn)."\n".$sql);
        return $result;
    }

    function deleteTeam(){
        $conn = $this->dbConnect();
        $results = mysqli_query($conn, "DELETE FROM equipe WHERE equipe.nom_e='".$_POST["nom_e"]."'");
        return $results;
    }

    function retireTeam($id_t){
        $conn = $this->dbConnect();
        $results = mysqli_query($conn, "DELETE FROM appartient WHERE appartient.id_e=".$_POST["id_e"]." AND appartient.id_t=".$id_t);
        return $results;
    }

    function addTeam2Tournament($id_t){
        $conn = $this->dbConnect();
        $results = mysqli_query($conn, "INSERT INTO appartient (id_e, id_t) VALUES ('".$_POST["add-team"]."', '".$id_t."')");
        return $results;
    }

    function getTeams2Add($id_t){
        $conn = $this->dbConnect();
        $results = mysqli_query($conn, "SELECT * FROM equipe AS e1 WHERE NOT EXISTS (SELECT * FROM appartient WHERE appartient.id_e=e1.id_e AND appartient.id_t=".$id_t.")");
        return $results;
    }

    function getTeamMatches(){
        $conn = $this->dbConnect();
        $sql = "SELECT * FROM rencontre r JOIN equipe e ON r.id_e1 = e.id_e OR r.id_e2 = e.id_e WHERE e.nom_e = '".$_POST["nom_e"]."'";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error($conn)."\n".$sql);
        return $result;
    }

    function getTeamPlayers(){
        $conn = $this->dbConnect();
        $sql = "SELECT * FROM joueur j JOIN equipe e ON j.id_e = e.id_e WHERE e.nom_e = '".$_POST["nom_e"]."'";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error($conn)."\n".$sql);
        return $result;
    }

    function addPlayer($id_t){
        $sql = "insert into joueur(nom_j, prenom_j, id_e) values('".$_POST["nom_j"]."', '".$_POST["prenom_j"]."', ".$id_t.")";
        $result = mysqli_query($this->dbConnect(), $sql);
        return $result;
    }

    function existPlayer(){
        $conn = $this->dbConnect();
        $result = mysqli_query($conn, "SELECT * FROM joueur WHERE nom_j='".$_POST["nom_j"]."'and prenom_j='".$_POST["prenom_j"]."'");
        $donnees=$result->fetch_assoc();
        
        if(is_null($donnees)==FALSE){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    function removePlayer(){
        $sql = "delete from joueur where nom_j = '".$_POST["nom_j"]."' and prenom_j = '".$_POST["prenom_j"]."'";
        $result = mysqli_query($this->dbConnect(), $sql);
        return $result;
    }

}


?>