# gestionTournois_G3

# Architecture MVC

## Introduction

Salut les bg, aujourd'hui on va voir les principes de l'architecture MVC : **M**odel **V**ue **C**ontroller.

C'est une façon super sympa de structurer le code pour ce genre d'appli et même si ça peut paraître un peu complexe au début c'est rien d'autre qu'une façon de structurer le code et bien séparer les différentes fonctions. Adopter cette architecture ça va nous faire gagner plein de points et plein de belles choses sur lesquelles se vanter dans le rapport. 

Techniquement oui ça marche de faire du code page par page mais ça risque d'être pas très beau ni pratique quand il va falloir tout mettre en commun ou même revenir ajouter des trucs par dessus etc et même c'est du code de loser et nous on est pas des losers bordel. Alors on va monter aux profs qu'on peut faire un beau projet organisé.

Ducoup je vous propose cette super architecture de sigma accompagnée de petits exemples pour bien que vous compreniez.
Si vous avez pas tout compris je vous conseil des ressources du style : https://openclassrooms.com/fr/courses/4670706-adoptez-une-architecture-mvc-en-php/4678736-comment-fonctionne-une-architecture-mvc

J'ai créer des exemples pour chaque éleménts donc hésitez pas à les reprendre pour créer les votre.

**Important** : dans ce que j'ai fait j'ai remplacé le français par de l'anglais. Je recommande qu'on fasse ça parce que c'est bien de s'y habituer maintenant quand on code, du style *equipe* devient *team* et *tour* devient *round* même pour les noms de fichier.

## Le principe

Concrètement le principe du MVC c'est ça :

*Model* <---> *Controller* --> *Vue*

 Le projet va être découper en plusieurs éléments :
- Les modèles : c'est eux qui vont faire l'interface avec la base de données pour récupérer les données, ils communiquent avec les controllers.

- Les controlleurs : ils vont faire le lien entre les modèles et la vue et c'est eux qui vont gérer toute la logique s'il y en a entre le moment où les données sont récupérées et celui où elles sont affichées.

- Les vues : c'est la partie frontend de l'app, ça va être du code html auquelle les controllers vont passer des données à afficher.

Avant d'aller plus en détails, petit détour sur l'organisation des fichiers :

## Structure du projet

```
📦gestionTournois_G3
 ┣ 📂app 
 ┃ ┣ 📂controller
 ┃ ┣ 📂model
 ┃ ┣ 📂public
 ┃ ┃ ┣ 📂css
 ┃ ┃ ┣ 📂images
 ┃ ┃ ┗ 📂js
 ┃ ┣ 📂view
 ┃ ┗ 📜index.php
 ┣ 📂data
```

Voili voilu p'tite structure classique d'application php mvc rien de fou

- `/app` contient les fichiers de code
    - `controller` contient les controllers
    - `model` les models
    - `view` pareil t'as capté
    - `public` c'est ici qu'on balance les ressources du projet : le css, le js et les images
- `/data` juste le script pour créer la base
- `index.php` c'est le routeur j'en parle a la fin tqt

## Models

On rentre dans le vif du sujet avec les modèles : ducoup comme j'tai dit c'est le code qui fait le lien avec la bdd. Concrètement ça va se traduire par une classe de ce style ( en php pour accéder en POO on utilise `->` à la place de `.` pour accéder aux membres d'un objet):

```php
// /!\ Le modèle n'est jamais appelée ailleur que dans le controller correspondant /!\

require_once("model/model.php"); // Import the Model Class

class ExampleModel extends Model {

    // Dans chaque fonction, on pense bien à 
    // appeler la méthode dbConnect héritée de
    // la classe Modele

    function getExample( $exampleID ){
        $this->dbConnect();

        // Code pour récupérer l'exemple avec l'id donnée

    }

    function getAllExamples(){
        $this->dbConnect();

        // Code pour récupérer tous les exemples

    }

    function addExample( $exampleID, $exampleName){
        $this->dbConnect();

        // Code pour ajouter un exemple à la bdd

    }

}
```
Voilà en gros un model c'est une classe qui définie des méthodes pour faire des opérations en lien avec la bdd, généralement ça sera toujours les mêmes :
- Récupérer toutes les enregistrement
- Récupérer un enregistrement particulier
- Ajouter un enregistrement
- Mettre un jour un enregistrement (j'ai pas mis dans l'exemple mais c'est le même principe on aurait une fonction updateExample)

Donc on a un model pour chaque donnée dans notre projet. Dans le cas de notre appli on devra donc créer des trucs genre teamModel, playerModel pour chaque table de notre BDD.

Il faut pas hésiter à rajouter des fonctions en fonction du besoin, exemple si on a besoin des joueurs d'une équipe on va rajouter une fonction getPlayersFromTeam($teamId) dans notre playerModel.

Tous les modèles doivent hériter de la classe Model qui implémente la méthode dbConnect qui sert juste à se connecter à la bdd :

```php
// Classe Model qui définie les fonctions communes à tous les modèles

class Model {

    protected function dbConnect(){
        // Faire le lien avec la BDD de Emma et retourner la variable $db
    }

}
```

## Views

Avant de parler des controllers, on va voir les vues.

Une vue c'est quoi, bah c'est juste du code html avec du php mon frère.

Le principe c'est quoi : pour chaque page on va créer une vue qui sera le contenu de la page. Chaque vue doit avoir une fonction bien délimitée.

Pour bien opti la réusabilité du code, on a un truc comme ça :

d'abord un fichier `template.php`
```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">

    <!-- Importer le style de la page correspondante -->
    <?php if(isset($style)){
        echo '<link rel="stylesheet" href="public/css/' . $style . '">';
    } ?>

    <title> <?= $title ?> </title>
</head>
<body>
    <?php require("header.php") ?>

    <?= $content ?>

    <?php require("footer.php") ?>
</body>
</html>
```

Ce fichier ça sera le template de chaque page, pas besoin d'y toucher. 

On peut voir dans le body qu'on inclut un fichier header et un fichier footer qui seront le header et le footer partagés par chaque page, c'est là qu'on pourra mettre le menu etc

La syntaxe `<?= $content ?>` c'est juste un raccourci pour `<?php echo $content ?>`.

Cette variable `$content` ça sera le code html retourner par nos vues, on pourra aussi préciser une variable `$style` pour le css correspondant a la page et `$title` pour renseigner le titre.

Quand je disais qu'une vue = une fonction délimitée, ça va se traduire par la création d'une vue pour chaque fonction différentes, ducoup on aura par exemple une vue teamView.php pour afficher une équipe et allTeamsView.php pour afficher toutes les équipes.

Une vue ça ressemble à ça, exemple avec `exampleView.php` :

```html
<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->

<?php 
    $title = 'Un exemple';  // Set the page Title
    $style = "example.css"; // Set the corresponding stylesheet
?>

<?php ob_start(); // Initialize content start ?>

    <!-- Content goes here -->

    <h1>Un Exemple</h1>
    <p>Tah l'exemple de malade</p>

    <!-- Afficher l'exemple $example définie dans le controller -->
    <p ><?= $example["exampleID"] ?> <?= $example["exampleName"] ?></p>


    <!-- End of content -->

<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>
```

Petite explication : 
- on commence par définir les variables `$title` et `$style`
- la fonction `ob_start()` enregistre tout le code html qu'on va echo jusqu'à ce qu'on appelle `ob_get_clean()`
- Ensuite on peut écrire tout le code html de la page qui sera le contenu du template, pour info dans un fichier php on peut fermer la balise php avec `?>` pour écrire du code html, c'est la même chose que se faire chier avec des echo `"<div>blablabla</div>"`
- A l'intérieur du contenu on a une variable `$example` qui sera l'exemple à afficher, cette variable elle sera définie par le controller qu'onva voir après
- pour finir on inclut `template.php`

Concrètement pour faire vos pages vous avez juste à copier coller ce fichier, changer le titre, le style et mettre votre contenu dans l'espace délimité par les commentaires.

Exemple avec `allExamplesView.php` pour afficher plusieurs enregistrements :
```html
<!-- /!\ La vue n'est jamais appelée ailleur que dans le controller correspondant /!\ -->

<?php 
    $title = 'Tous les Exemples';  // Set the page Title
    $style = "allExamples.css"; // Set the corresponding stylesheet
?>

<?php ob_start(); // Initialize content start ?>


    <!-- Content goes here -->

    <h1>Tous les Exemples</h1>
    <p>Tah l'exemple de malade</p>

    <ul>
    <?php

        // Afficher chaque exemple, la variable $examples
        // est définie dans le controlleur exampleController
        foreach($examples as $example){
            ?>

            <li><?= $example["exampleID"] ?> <?= $example["exampleName"] ?></li>

            <?php
        }

    ?>
    </ul>

    <!-- End of content -->

<?php $content = ob_get_clean(); // Get the html content into the content var ?>

<?php require('template.php'); ?>
```
Voila ici c'est la même sauf qu'on a `$examples` qui sera définie par le controller et contiendra tous les examples à afficher.

Donc en résumer les vues on va juste définir le contenu du template qu'il faut pas oublier d'include avec `require` a la fin, dans votre vue vous pouvez utiliser les variables que vous voulez pour rendre la page dynamique enfait, du style dans `allTeamsView.php` tu utilises `$teams` qui sera un tableau de toutes les équipes.

## Controllers

Finalement on a les controllers, c'est eux qui vont faire le lien avec les modèles et les vues. On va avoir un controlleur par modèle en gros et ça se traduit par une classe comme ça :

`exampleController` :

```php
<?php
    require_once("model/exampleModel.php"); // Import the example Model

    class ExampleController{

        private $exampleModel = new ExampleModel(); // Bien définir le modèle correspondant

        function displayExample($exampleID){

            // Récupérer l'exemple définie par le paramètre avec notre modele
            $example = $this->exampleModel->getExample($exampleID);

            // Afficher la vue correspondante :

            // ATTENTION : vérifier à bien faire correspondre les variables
            // dans la vue et dans le controller : ici exampleView attend une
            // variable nommée $example
            require("view/exampleView.php");

        }

        function displayAllExamples(){

            // Récupérer tous les exemples avec le modele
            $examples = $this->exampleModel->getAllExamples();
            
            // Afficher la vue correspondante :

            // ATTENTION : vérifier à bien faire correspondre les variables
            // dans la vue et dans le controller : ici allExamplesView attend une
            // variable nommée $examples
            require("view/allExamplesView.php");

        }

        function postExample($exampleID, $exampleName){

            // Effectuer ici tous les traitements et vérifications des données nécessaires
            

            // Ajouter l'example à la bdd avec le modele
            $this->exampleModel->addExample($exampleID, $exampleName);

        }
    }
?>
```
Un controller ça contient des fonctions pour les actions à effectuer en rapport avec le model.

On pense donc bien à inclure le model correspondant au début.

Après pareil comme pour les models souvent on a les mêmes fonctions :
- Afficher un enregistrement
- Afficher tous les enregistrements
- Ajouter un enregistrement
- Mettre à jour un enregistrement

Dans notre classe, on commence bien par créer une instance du model correspondant. 

Ensuite par exemple pour afficher un ou plusieurs enregistrement l'idée c'est la suivante : dans la fonction on utilise les fonctions du modèle pour récupérer les données qu'on eut afficher, attention il faut bien que la variable ait le même nom que celle dans la vue. Ensuite il suffit d'inclure la vue qui correspond à l'action.

Donc quand y faut juste afficher des enregistrements c'est simple, mais si y'a de la logique en plus c'est là qu'on va faire tous les traitements, du style vérifier les données du formulaire avant d'essayer d'ajouter à la bdd.

## Routeur

Dernier élements pour l'instant, dans notre app il va falloir faire du routing pour gérer les pages à afficher, c'est le rôle du ficher `index.php` :
```php
<?php 

    // Controller Imports

    require_once("controller/exampleController.php");

    // End of controller imports


    //Controller declarations

    $exampleController = new ExampleController();

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
        }

    }
    else{
        // Par défaut charger l'acceuil
        // Pour être plus consistent on pourrait faire un controller juste
        // pour charger l'acceuil mais basta si c'est une page static
        require("view/home.php");
    }

?>
```

Explications :
- On commence par importer et instancier tous nos controlleurs.
- Toutes les url de notre appli hors l'acceuil seront du style `index.php?action=`, avec la variable `$_GET["action"]` on va pouvoir décider quelle action effectuer. Ainsi si on a `index.php?action=listExamples` ce sera l'url pour la page de la liste des examples.
- On va donc faire un switch sur cette variable (pour éviter plein de if else) et chaque case correspond à une route de notre application.
- Pour chaque route, on définie l'action à effectuer, si l'action c'est `listExamples` on va appeler la méthode `displayAllExamples()` de notre `exampleController` qui va se charger de récupérer les données et afficher la page correspondante.
- On peut avoir des routes avec plus de paramètre, du genre pour afficher un example il faut savoir lequel, ducoup l'url ça serait `index.php?action=example&id=1` par exemple, ducoup dans le case qui gère l'action `example` il faut bien vérifier que le paramètre `id` est définie avant d'appeler la méthode `displayExample()` du controller en donnant l'id de l'example qu'on veut afficher.

## Conclusion

Voila en gros c'est ça j'éspère c'est clair pcq en vrai c'est pas compliqué mvc c'est juste une histoire de bien séparer chaque fonctions du code et puis merde c'est pas beau à voir un projet comme ça.

Si vous avez des questions hésitez pas et comme je l'ai dit en vrai pour commencer y suffira de copier coller les fichiers d'exemple et modifier à votre convenance. 

Voilà après faudra que je vous explique l'AJAX en gros c'est juste utiliser du js pour envoyer nos formulaires pour éviter que ça fasse recharger toute la page quand tu valides un formulaire ou carrément faire changer de page
mais la flemme jsuis fatigué