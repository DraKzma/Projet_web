<?php

session_start();
include "connex.inc.php";

function affichage_non_connectee(){
    echo "<h3>Vous devez vous connecter pour jouer à notre chasse au trésor <strong>INCROYABLE</strong></h3>\n";
    echo "ça se passe ici <a href='connexion.php'>Se connecter</a>\n";
}

function affichage_connectee(){
    echo "<h2>TESTS</h2>\n";
    $pseudo = $_SESSION['pseudo'];
    $statut = $_SESSION['statut'];
    $progres = $_SESSION['progres'];
    echo "$pseudo $statut $progres";
}

function choix_affichage(){
    if(!isset($_SESSION["pseudo"]) || !isset($_SESSION["statut"]) || !isset($_SESSION["progres"])){
        affichage_non_connectee();
    }
    else{
        affichage_connectee();
    }
}

?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <title>Choix_TRESOR</title>
    </head>
    <body>

        <?php choix_affichage(); ?>
            
    </body>
</html>