<?php 

    // Controller Imports

    // require_once("controller/exampleController.php");
    require_once("controller/homeController.php");
    include_once("controller/tournamentController.php");
    include_once("controller/TeamController.php");

    // End of controller imports


    //Controller declarations
    $homeController = new HomeController();
    $tournamentController = new TournamentController();
    $teamController = new TeamController();

   // $exampleController = new ExampleController();

    // End of controller declarations




    if( isset($_POST["action"]) ){

        
        // Routes

        switch($_POST["action"]){

            case "home_button":
                $homeController->displayHome();
                break;

            case "see_tournaments":
                $tournamentController->displayAllTournament();
                break;              

            case "see_teams":
                $teamController->displayAllTeams();
                break;


            case "addTournament":
                $tournamentController->addTournament();
                break;
            
            case "page_addTournament":
                $tournamentController->displayAddTournament();
                break;
            
            case "page_addTeam":
                $teamController->displayAddTeam();
                break;
            
            case "addTeam":
                $teamController->addTeam();
                break; 

            case "one_tournament":
                $tournamentController->displayOneTournament();
                break;
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