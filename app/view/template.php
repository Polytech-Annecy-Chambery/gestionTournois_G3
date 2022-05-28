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

    <div class = "background">
    <?= $content ?>
    </div>

    <?php require("footer.php") ?>

</body>
</html>