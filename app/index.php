<?php 

    // Controller Imports

    // require_once("controller/exampleController.php");
    require_once("controller/homeController.php");
    require_once("controller/tournamentController.php");
    require_once("controller/matchController.php");

    // End of controller imports


    //Controller declarations
    $homeController = new HomeController();
    $tournamentController = new TournamentController();
    $matchController = new MatchController();

    // $exampleController = new ExampleController();

    // End of controller declarations




    if( isset($_GET["action"]) ){

        
        // Routes

        switch($_GET["action"]){

            case "listExamples":
                $exampleController->displayAllExamples();
                break;

            case "tournamentTree":
                if(isset($_GET["id"])){
                    $tournamentController->displayTournamentTree($_GET["id"]);
                }
                break;

            case "updateTournamentMatch":
                if(isset($_GET["id_r"])){
                    $matchController->updateAndCreateMatch($_GET["id_t"],$_GET["id_r"]);
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