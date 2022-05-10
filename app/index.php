<?php 

    // Controller Imports

    // require_once("controller/exampleController.php");
    require_once("controller/homeController.php");

    // End of controller imports


    //Controller declarations
    $homeController = new HomeController();

    // $exampleController = new ExampleController();

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

            // index.php?action=postTournoi
            // case "postTournoi":
            //     if(...){
            //         $tournamentController->postTournament(...)
            //     }
                    
        }

    }
    //index.php/
    else{
        // Par défaut charger l'acceuil
        // Pour être plus consistent on pourrait faire un controller juste
        // pour charger l'acceuil mais basta si c'est une page static
        $homeController->displayHome();
    }

?>