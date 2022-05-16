<?php 

    require_once("controller/homeController.php");
    $homeController = new HomeController();


    if( isset($_GET["action"]) ){

    }

    else{
        $homeController->displayHome();
    }

?>