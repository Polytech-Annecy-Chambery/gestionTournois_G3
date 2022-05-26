<?php 

    // Controller Imports

    // require_once("controller/exampleController.php");
    require_once("controller/homeController.php");
    include_once("controller/tournamentController.php");
    include_once("controller/TeamController.php");
    include_once("controller/matchController.php");

    // End of controller imports


    //Controller declarations
    $homeController = new HomeController();
    $tournamentController = new TournamentController();
    $teamController = new TeamController();
    $matchController = new MatchController();

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
            
            case "one_team":
                $teamController->displayTeamInfos();
                break;

            case "delete_tournament":
                $tournamentController->deleteTournament();
                break;
            
            case "delete_team":
                $teamController->deleteTeam();
                break;
            
            case "retire_team":
                $tournamentController->retireTeam();
                break;
            
            case "addTeam2Tournament":
                $tournamentController->addTeam2Tournament();
                break;
            
            case "tournamentTree":
                if(isset($_POST["nom_t"])){
                    $tournamentController->displayTournamentTree($_POST["nom_t"]);
                }
                break;

            case "updateTournamentMatch":
                if(isset($_POST["id_r"])){
                    $matchController->updateAndCreateMatch($_POST["id_t"],$_POST["id_r"]);
                }
                break;

            case "addPlayer":
                $teamController->addPlayer();
                break;

            case "deletePlayer":
                $teamController->deletePlayer();
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