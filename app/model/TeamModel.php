<?php
// /!\ Le modèle n'est jamais appelée ailleur que dans le controller correspondant /!\


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
}


?>