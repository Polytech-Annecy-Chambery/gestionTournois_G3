<?php
    // /!\ Le modèle n'est jamais appelée ailleur que dans le controller correspondant /!\

    require_once("model/Model.php"); // Import the Model Class

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

            if (isset($_POST["choisir"])){
                $sql = "select * from joueur where id_e = (select id_e from equipe where id_e = ".$_POST['liste_equipe'].")";
                $players = mysqli_query($this->dbConnect(), $sql);
                return $players;
                echo "<p>Les joueurs de l'équipe séléctionnés sont les suivants : </p>";
            }
            
            echo "<h1>Tous les joueurs</h1>";

            echo "Equipe: <select name=\"liste_equipe\">";
            echo "<option>--Choisissez l'équipe--";
            $sql = "select nom_e from equipe";
            $result = mysqli_query($this->dbConnect(), $sql);
            while ($row = mysqli_fetch_array($result)) {
                echo "<option>".$row[0];
            }
            echo "</select>";

            echo "<br>";

            echo "<input type=\"submit\" name=\"choisir\" value=\"Voir joueurs\" />";


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