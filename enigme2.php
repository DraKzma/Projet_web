<?php

session_start();
include "connex.inc.php";

function ajout_niveau(){
    $pseudo = $_SESSION["pseudo"];
    $progres = $_SESSION["progres"];
    if($progres < 2){
        $base = "tresor.sqlite";
        $pdo = connex($base);
        $stmt = $pdo->prepare("UPDATE joueurs SET progres = 2 WHERE pseudo = :pseudo");
        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->execute();
        $_SESSION["progres"] = 2;
    }
    header("Location:enigme2.php");
}

function affichage_non_connectee(){
    echo "<h3>Vous devez vous connecter pour jouer à notre chasse au trésor <strong>INCROYABLE</strong></h3>\n";
    echo "ça se passe ici <a id='lien1' href='connexion.php'>Se connecter</a>\n";
}

function affichage_bloquee(){
    echo "<h3>Alors il se trouve que vous n&apos;avez pas encore débloqué cette énigme, c&apos;est bien <strong>DOMMAGE</strong></h3>\n";
    echo "Pour retournez au choix des énigmes c&apos;est par ici <a href='choix_enigme.php'>Choix</a>\n";
}

function affichage_connectee(){
    echo "<h1>Enigme N°2</h1>\n";
    echo "<h2>Test d&apos;adresse:</h2>\n";
    echo "<p>Pour cette énigme, ou plutôt test, vous allez devoir cliquez le plus rapidement possible sur un lien qui vas apparaître à un endroit aléatoire de la page. Si vous êtes trop lent, vous serez rediriger sur cette page !</p>\n";
    echo "<p><strong id='condition'>Conditions de réussite:</strong> Cliquez sur le lien qui apparaît sur la page avant la fin du temps imparti jusqu&apos;à être rediriger sur la page de la prochaine énigme.</p>\n";
    echo "<br>\n";
    echo "<span>Bonne chance !</span>\n";
    echo "<br><br><br>\n";
    echo "<a id='lien1' href='enigme2.php?etape=0'>Commencer </a>\n";
    echo "<br><br><br><br>\n";
    echo "<span>Si vous voulez retourner au choix des énigmes, cliquez ici <a id='lien2' href='choix_enigme.php'>Choix</a></span>\n";
}

function chrono($duree){
    echo "<script>decompte($duree);</script>\n";
    header( "refresh:$duree; url=enigme2.php" );
}

function affichage_connectee_GET(){
    $espace = rand(0, 145);
    $saut = rand(0, 30);
    $suivant = $_GET["etape"] + 1;
    $temps = 3 - 0.2 * $_GET["etape"];
    echo "<header>\n";
    if($temps == 3 || $temps == 2 || $temps == 1 || $temps == 0){
        echo "<span id='temps'>Temps: <span id='chrono'>"."0"."$temps".".00"."</span></span>\n";
    }
    else{
        echo "<span id='temps'>Temps: <span id='chrono'>"."0"."$temps"."0"."</span></span>\n";
    }
    echo "<br>\n";
    echo "<strong id='bord'>";
    for($i=0; $i<52; $i++){
        echo "_";
    }
    echo "</strong>\n";
    echo "</header>\n";
    for($i=0; $i<$saut; $i++){
        echo "<br>\n";
    }
    $saut = 30 - $saut;
    echo "<p>";
    for($i=0; $i<$espace; $i++){
        echo "&nbsp;";
    }
    if($suivant != 11){
        echo '<a id="bouton" href="enigme2.php?etape='."$suivant".'"></a>';
    }
    else{
        echo '<a id="bouton" href="enigme3.php?update=1"></a>';
    }
    echo "</p>\n";
    for($i=0; $i<$saut; $i++){
        echo "<br>\n";
    }
    echo "<footer>\n";
    echo "<strong id='bord'>";
    for($i=0; $i<52; $i++){
        echo "_";
    }
    echo "</strong>\n";
    echo "</footer>\n";
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
            if($_SESSION["progres"] < 2){
                affichage_bloquee();
            }
            else{
                if(!isset($_GET["etape"])){
                    affichage_connectee();
                }
                else{
                    affichage_connectee_GET();
                    $duree = 3 - 0.2 * $_GET["etape"];
                    chrono($duree);
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Enigme2</title>
        <link rel="stylesheet" href="enigme2.css">
        <script src="enigme2.js"></script>
    </head>
    <body>
        
        <div id="contenu">
            <?php choix_affichage(); ?>
        </div>
        
    </body>
</html>