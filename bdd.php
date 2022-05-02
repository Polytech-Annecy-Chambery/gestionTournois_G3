<!-- Faire le lien avec la BDD de Emma

Page à inclure au dessus de chaque page -->

<?php  
        // Connexion à la base de données sur le serveur tp-epua
        // variable $conn peut être utilisée dans tout le code
		$conn = mysqli_connect("tp-epua:3308", "orsete", "d3imtm9m") or die("Impossible de se connecter : ". mysqli_connect_error());

        /*Sélection de la base de données*/
        mysqli_select_db($conn, "orsete") or die("Impossible de sélectionner la base: ". mysqli_connect_error());   
        
        /*Encodage UTF8 pour les échanges avec la BD*/
        mysqli_query($conn, "SET NAMES UTF8");
  ?>