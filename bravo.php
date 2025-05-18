<?php

session_start();
include "connex.inc.php";

function ajout_niveau(){
    $pseudo = $_SESSION["pseudo"];
    $progres = $_SESSION["progres"];
    if($progres < 5){
        $base = "tresor.sqlite";
        $pdo = connex($base);
        $stmt = $pdo->prepare("UPDATE joueurs SET progres = 5 WHERE pseudo = :pseudo");
        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->execute();
        $_SESSION["progres"] = 5;
    }
    header("Location:bravo.php");
}

function affichage_non_connecte(){
    echo "vous ne pouvez pas accéder à cette page car vous n'êtes pas connecté \n";
    echo "ça se passe ici <a href='connexion.php'>Se connecter </a>";
}

function affichage_connectee(){
    $progres=$_SESSION["progres"];
    if ($progres != 5){
        echo "vous ne pouvez pas accéder à cette page car vous n'avez pas remplis toutes les énigmes";
    }
    else{

        /* Affichage du début */

        echo "<h1>Vous avez réussi</h1>\n";
        echo "<h2>(vous êtes vraiment très très fort)</h2>\n";
        echo "<p>Voici la liste des autres membres très très fort:</p>\n";
        

        /* Affichage de la liste des membres qui ont réussi */
        
        $pdo=connex("tresor.sqlite");
        $stmt=$pdo->prepare("SELECT pseudo FROM joueurs WHERE progres = 5");
        $stmt->execute();
        $bdd_pseudo=$stmt->fetchAll();
        echo "<ul>\n";
        for ($i=0 ; $i<count($bdd_pseudo) ; $i++){
            echo "<li>\n";
            $blaze = $bdd_pseudo[$i]['pseudo'];
            echo "$blaze\n";
            echo "</li>\n";
        }
        echo "</ul>\n";

        /* Affichage de la fin */

        echo "<p>Ben voilà, c&apos;est la fin. Vous pouvez retourner au choix des énigmes si vous voulez.</p>\n";
        echo "C&apos;est par ici: <a href='choix_enigme.php'>Choix</a>\n";
    }
    
}

function choixAffichage(){
    if(!isset($_SESSION["pseudo"]) || !isset($_SESSION["statut"]) || !isset($_SESSION["progres"])){
        affichage_non_connectee();
    }
    else{
        if(isset($_GET["update"])){
            ajout_niveau();
        }
        else{
            affichage_connectee();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Bravo </title>
    <link rel="stylesheet" href="bravo.css">
  </head>
  <body>

      <?php choixAffichage(); ?>
      
  </body>

</html>
