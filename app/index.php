<?php 

    // Controller Imports


    require_once("controller/player_controller.php");

    // End of controller imports


    //Controller declarations

    $exampleController = new ExampleController();

    $playerController = new PlayerController();

    // End of controller declarations



    //index.php?action=
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

            case "displayPlayer":
                if(isset($_GET["id"])){
                    $playerController->displayPlayer($_GET["id"]);
                }
        }

    }
    else{
        // Par défaut charger l'acceuil
        // Pour être plus consistent on pourrait faire un controller juste
        // pour charger l'acceuil mais basta si c'est une page static
        require("view/home.php");
    }

?>