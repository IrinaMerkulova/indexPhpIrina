<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Irina php leht</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="js/canvasscript.js"></script>
    <script src="js/"></script>

</head>
<body>
<!--päis-->
<?php
    include('header.php');
?>
<!--navigeerimismenüü-->
<?php
include('nav.php');
?>
<!--sisu--interpritatoor: C/XAMPP/PHP/php.exe-->
<main>
    <?php
    if(isset($_GET["veebileht"])){
        include('content/'.$_GET["veebileht"]);
    } else {

        echo "Tere tulemast, siin sa leiad ....";
    }

    ?>
</main>
<!--jalus-->
<?php
include('footer.php');
?>
</body>
</html>