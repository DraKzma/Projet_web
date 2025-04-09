<?php

session_start();
include "connex.inc.php";

function affichage_non_connecte(){
    echo "vous ne pouvez pas accéder à cette page car vous n'êtes pas connecté \n";
    echo "ça se passe ici <a href='connexion.php'>Se connecter </a>";
}
  
function affichage_connecte(){
    $progres=$_SESSION["progres"];
    if ($progres != 6){
        echo "vous ne pouvez pas accéder à cette page car vous n'avez pas remplis toutes les énigmes";
    }
    else{
        $pdo=connex("tresor.sqlite");
        $stmt=$pdo->prepare("SELECT pseudo FROM joueurs WHERE progres = 6");
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
        
    }
    
}

function choixAffichage(){
    if (isset($_SESSION["pseudo"])){
        affichage_connecte();
    }
    else{
        affichage_non_connecte();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Bravo </title>
  </head>
  <body>

      <?php choixAffichage(); ?>
      
  </body>

</html>
