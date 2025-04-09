<?php

session_start();
include "connex.inc.php";

function affichage_non_connectee(){
    echo "<h3>Vous devez vous connecter pour jouer à notre chasse au trésor <strong>INCROYABLE</strong></h3>\n";
    echo "ça se passe ici <a href='connexion.php'>Se connecter</a>\n";
}

function affichage_connectee(){
    echo "<h1>Choix de l&apos;énigme</h1>\n";
    echo "<p><em>Choisissez l'énigme à laquelle vous voulez commencez. Vous avez seulement accès aux énigmes que vous avez débloquées.</em></p>\n";
    $pseudo = $_SESSION['pseudo'];
    $statut = $_SESSION['statut'];
    $progres = $_SESSION['progres'];
    echo "<ul>\n";
    for($i=1; $i<=6; $i++){
        if($i==6){
            echo "<li>\n";
            echo "<em>Fin : </em>";
            if($progres >= $i){
                echo "<strong><a href='bravo.html'>Bravo</a></strong>\n";
            }
            else{
                echo "<strong>Page non débloquée</strong>\n";
            }
            echo "</li>\n";
        }
        else{
            echo "<li>\n";
            echo "<em>Enigme $i : </em>";
            if($progres >= $i){
                echo '<strong><a href="enigme'.$i.'.php">Enigme '.$i.'</a></strong>'."\n";
            }
            else{
                echo "<strong>Page non débloquée</strong>\n";
            }
            echo "</li>\n";
        }
    }
    echo "</ul>\n";
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