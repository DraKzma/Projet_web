<?php

session_start();
include "connex.inc.php";

function ajout_niveau(){
    $pseudo = $_SESSION["pseudo"];
    $progres = $_SESSION["progres"];
    if($progres < 3){
        $base = "tresor.sqlite";
        $pdo = connex($base);
        $stmt = $pdo->prepare("UPDATE joueurs SET progres = 3 WHERE pseudo = :pseudo");
        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->execute();
        $_SESSION["progres"] = 3;
    }
    header("Location:enigme3.php");
}

function affichage_non_connectee(){
    echo "<h3>Vous devez vous connecter pour jouer à notre chasse au trésor <strong>INCROYABLE</strong></h3>\n";
    echo "ça se passe ici <a href='connexion.php'>Se connecter</a>\n";
}

function affichage_bloquee(){
    echo "<h3>Alors il se trouve que vous n&apos;avez pas encore débloqué cette énigme, c&apos;est bien <strong>DOMMAGE</strong></h3>\n";
    echo "Pour retournez au choix des énigmes c&apos;est par ici <a href='choix_enigme.php'>Choix</a>\n";
}

function affichage_connectee(){
    echo "<h1>Enigme N°3</h1>\n";
    echo "<h2>Test de mémoire:</h2>\n";
    echo "<p>Oui on sait, c&apos;est censé être une chasse au trésor avec des énigmes mais il y'a un test d&apos;adresse et un test de mémoire avec des timers et tout ça tout ça. On vous promet que les prochaines énigmes seront vraiment des énigmes. Bref..</p>\n";
}

function choix_affichage(){
    if(!isset($_SESSION["pseudo"]) || !isset($_SESSION["statut"]) || !isset($_SESSION["progres"])){
        affichage_non_connectee();
    }
    else{
        if(isset($_GET["update"])){
            ajout_niveau();
        }
        else{
            if($_SESSION["progres"] < 3){
                affichage_bloquee();
            }
            else{
                affichage_connectee();
            }
        }
    }
}

?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <title>Document</title>
    </head>
    <body>
        <?php choix_affichage(); ?>
    </body>
</html>