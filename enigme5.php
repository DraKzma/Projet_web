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
    header("Location:enigme5.php");
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
    echo "<h1>Enigme N°5</h1>\n";
    $questions = [
    
        "Première question " => ["Réponse A", "Réponse B", "Réponse C",1],    
        "Seconde question " => ["Réponse A", "Réponse B", "Réponse C",2]
    
    ];
    echo "<p>Bienvenue dans cette 5eme et derniere énigme ! dans cette énigme vous devez réaliser une sorte de mini compréhension oral comme on le faisait au lycée :) vous devez répondre juste aux 2 questions pour enfin pouvoir finir notre challenge ! </p>";
    echo "<h1>Lecture de l'audio principal</h1>";
    echo "<audio controls>";
    echo "<source src='comprehension.wav' type='audio/wav'>";
    echo "</audio>";
    echo "<br>";
    if (!isset($_SESSION['tentative_enigme_5'])) {
    $_SESSION['tentative_enigme_5'] = 1;
    
    }
    $score=null;
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
            $_SESSION['tentative_enigme_5']++;
        }
    }
    if ($score == null || $score < 3){

      $i=0;
      foreach ($questions as $question => $reponse){
          echo "<audio controls>";
          echo "<source src='question$i.wav' type='audio/wav'>";
          echo "</audio>";
          echo "<br>";
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
$_SESSION["progres"]=5;
    
function choix_affichage(){
    if(!isset($_SESSION["pseudo"]) || !isset($_SESSION["statut"]) || !isset($_SESSION["progres"])){
        affichage_non_connectee();
    }
    else{
        if(isset($_GET["update"])){
            ajout_niveau();
        }
        else{
            if($_SESSION["progres"] < 5){
                affichage_bloquee();
            }
            else{
                affichage_connectee();
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Enigme 5</title>
        <meta charset="utf-8">
    </head>
    <body>

        <div id="contenu">
            <?php choix_affichage(); ?>
        </div>

    </body>
</html>