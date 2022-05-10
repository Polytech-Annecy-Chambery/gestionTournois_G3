<?php
    // /!\ Le modèle n'est jamais appelée ailleur que dans le controller correspondant /!\

    require_once("model/model.php"); // Import the Model Class

    class PlayerModel extends Model {

        // Dans chaque fonction, on pense bien à 
        // appeler la méthode dbConnect héritée de
        // la classe Modele

        function getPlayer( $ID ){
            $this->dbConnect();
            $sql = "select nom_j, prenom_j from joueur where id_j = ".$ID;
            $result = mysqli_query($this->dbConnect(), $sql);
            return $result;

        }

        function getAllPlayers(){
            $this->dbConnect();

            $sql = "select * from joueur ";
            $result = mysqli_query($this->dbConnect(), $sql);
            return $result;

        }

        function addPlayer( $nom, $prenom, $id_e){
            $this->dbConnect();
            $sql = "insert into joueur (nom_j, prenom_j, id_e) values ('".$nom."','".$prenom."','".$id_e."')";
            $result = mysqli_query($this->dbConnect(), $sql);
        }

        function removePlayer($id){
            $this->dbConnect();
            $sql = "delete from joueur where id_j = ".$id;
            $result = mysqli_query($this->dbConnect(), $sql);
        }

        function getIDPlayer($nom, $prenom){
            $this->dbConnect();
            $sql = "select id_j from joueur where nom_j='".$nom."' and prenom_j='".$prenom."'";
            $result = mysqli_query($this->dbConnect(), $sql);
            return $result;
        }

    }


?>