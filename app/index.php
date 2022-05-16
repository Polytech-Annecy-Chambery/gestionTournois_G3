<?php 

    // Controller Imports

    require_once("controller/CreateTeamController.php");

    // End of controller imports


    //Controller declarations

    $teamController = new CreateTeamController();
    

    // End of controller declarations




    if( isset($_GET["action"]) ){

        
        // Routes

        switch($_GET["action"]){

            case "listExamples":
                $exampleController->displayAllExamples();
                break;

            case "example":
                if(isset($_GET["id"])){
                    $exampleController->displayExample($_GET["id"]);
                }
                break;

            case "postExample":
                if(isset($_GET["id"]) && isset($_GET["name"])){
                    $exampleController->postExample($_GET["id"], $_GET["name"]);
                }
                break;
            
            case "Ajouter" :
                $teamController->postTeam($_GET['nom']);
                require("view/teamView.php");
                break;
        }

    }
    
    else{
        // Par défaut charger l'acceuil
        // Pour être plus consistent on pourrait faire un controller juste
        // pour charger l'acceuil mais basta si c'est une page static
        require("view/teamView.php");
    }
    

?>