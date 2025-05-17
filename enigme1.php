<?php
session_start();
include "connex.inc.php";

$questions = [
    "Quelle joueur de foot est surnommé CR7" => ["Lionel Messi", "Neymar", "Cristiano Ronaldo", 2],
    "Quel est le plus haut volcan d'Italie" => ["Etna", "Stromboli", "Vulcano", 0],
    "Quel est le langage de programmation le plus populaire parmis ces 3" => ["C", "Python", "Rust", 1],
    "Qui est l'actuel champion du monde des rallyes (WRC)" => ["Sébastien Loeb", "Thierry Neuville", "Sébastien Ogier", 1],
    "Quel est le nom du plus haut point dans le massif central" => ["Le puy de la négère", "Le puy de fraisse", "Le puy de sancy", 2]
];

function affichage_non_connectee(){
    echo "<h3>Vous devez vous connecter pour jouer à notre chasse au trésor <strong>INCROYABLE</strong></h3>\n";
    echo "ça se passe ici <a href='connexion.php'>Se connecter</a>\n";
}


function affichage_connectee(){
    echo "<p> Bienvenue sur la première énigme ! l'objectif est de réussir a obtenir un score de 3 sur 5 sur ce petit test de culture général ! bonne chance :) </p>";
    $score = null;
$message = "";

// Réinitialisation de la session si nécessaire
if (!isset($_SESSION['tentative'])) {
    $_SESSION['tentative'] = 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    $i = 0;

    foreach ($questions as $q => $reponse) {
        $bonne = $reponse[3];
        if (isset($_POST["q$i"]) && $_POST["q$i"] == $bonne) {
            $score++;
        }
        $i++;
    }

    if ($score >= 3) {
        echo "bravo! ";
        session_destroy();
    } else {
        $_SESSION['tentative']++;
    }
}
  if ($score == null || $score < 3){
      echo "<form method='post'>";
      $i=0;
      foreach ($questions as $question => $reponse){
          echo "<p><strong>$question</strong></p>";
          for ($j=0 ; $j<3 ; $j++){
              echo "<label>$reponse[$j]<input type='radio' name='q$i' value='$j' required></label>";
              echo "<br>";
          }
          $i++;
      }
      echo "<button type='submit'>Soumettre</button>";
      echo "</form>";
      
  }

}
$_SESSION["pseudo"]="nico";
$_SESSION["statut"]="rr";
$_SESSION["progres"]=2;

function choix_affichage(){
    if(!isset($_SESSION["pseudo"]) || !isset($_SESSION["statut"]) || !isset($_SESSION["progres"])){
        affichage_non_connectee();
    }
    else{
        affichage_connectee();
    }
}
 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini Questionnaire</title>
</head>
<body>
    <h2>Mini Questionnaire </h2>
   <?php choix_affichage(); ?>
</body>
</html>








