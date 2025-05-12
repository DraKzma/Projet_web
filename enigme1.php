<?php

session_start();
include "connex.inc.php";


function affichage_non_connectee(){
    echo "<h3>Vous devez vous connecter pour jouer à notre chasse au trésor <strong>INCROYABLE</strong></h3>\n";
    echo "ça se passe ici <a href='connexion.php'>Se connecter</a>\n";
}

function affichage_connectee(){
    echo "<h1>Enigme N°2</h1>\n";
    echo "<p>Bienvenue sur cette toute première enigme ! vous avez pour l'instant réussi le premier challenge : vous connecter ! cette première énigme constistera en un test de culture général ! pour le réussir vous devrez au minimum faire un résultat de 8 points sur 10 ! Après l'avoir réussi vous débloquerez l'enigme suivante </p>";
    echo "<p> veuillez selectionner le thème sur lequel vous souhaitez être questionné ! </p>";
    echo "<form action='enigme1_questionnaire.php' method='post'>";
    echo "<button type='submit' name='histoiregeo' >Histoire et Geographie</button>";
    echo "<button type='submit' name='foot' >L'histoire du Football</button>";
    echo "</form>";
}
    function choix_affichage(){
    if(!isset($_SESSION["pseudo"]) || !isset($_SESSION["statut"]) || !isset($_SESSION["progres"])){
        affichage_connectee();
    }
    else{
        affichage_connectee();
    }
}
    
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Enigme1</title>
    <link rel="stylesheet" href="enigme1.css">
  </head>
  <body>
     <?php choix_affichage(); ?>
  </body>
</html>
  










