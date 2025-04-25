<?php

session_start();
include "connex.inc.php";

function affichage_connectee(){
    echo "<h3>Vous êtes déjà connecté, qu'attendez vous?</h3>\n";
    echo "<p><em>Pour accéder aux énigmes c&apos;est par ici : <strong><a href='choix_enigme.php'>Choix</a></strong>\n";
}

function afficheFormulaire($p){
    echo "<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."'method='post'>\n";
    echo "<label>Pseudo: <input id='pseudo' type='text' value='".$p."' name='pseudo' required='required'></label>\n";
    echo "<br>\n";
    echo "<label>Mot de passe: <input id='mdp' type='password' name='mdp' required='required'></label>\n";
    echo "<br>\n";
    echo "<button id='envoi' type='submit' name='envoi'>Submit</button>\n";
    echo "<br\n>";
    echo "</form>\n";
}

function affichage_connection(){
    echo "<h3>Inscription réussie, amusez vous bien!</h3>\n";
    echo "<a href='connexion.php'>Connexion</a>";
}

function choix_affichage(){
    if(isset($_SESSION["pseudo"])){
        affichage_connectee();
    }
    else{
        if(isset($_POST["pseudo"])){
            $pseudo = $_POST["pseudo"];
            $mdp = $_POST["mdp"];

            $base = "tresor.sqlite";
            $pdo = connex($base);

            $stmt = $pdo->prepare("SELECT pseudo FROM joueurs WHERE pseudo = :pseudo");
            $stmt->bindParam(":pseudo", $pseudo);
            $stmt->execute();
            $bdd_pseudo = $stmt->fetchAll();
            if(count($bdd_pseudo) != 0){
                afficheFormulaire("Ce pseudo est déjà utilisé");
            }
            else{
                $mdp = md5($mdp);
                $stmt = $pdo->prepare("INSERT INTO joueurs VALUES (:pseudo, :mdp, 0, 1)");
                $stmt->bindParam(":pseudo", $pseudo);
                $stmt->bindParam(":mdp", $mdp);
                $stmt->execute();
                affichage_connection();
            }
            $pdo=null;
        }
        else{
            afficheFormulaire(null);
        }
    }
}

?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <title>Inscription_TRESOR</title>
        <link rel="stylesheet" href="inscription.css">
    </head>
    <body>
      <h1> BIENVENUE SUR LA PAGE D'INSCRIPTION </h1>
      <h2> sur cette page vous allez pouvoir vous inscrire </h2>
      <?php choix_affichage(); ?>
      
    </body>
</html>