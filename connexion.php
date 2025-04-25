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
    echo "<button id='envoie' type='submit' name='envoi'>Connexion</button>\n";
    echo "<br\n>";
    echo "</form>\n";
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

            $mdp_code = md5($mdp);
            $stmt = $pdo->prepare("SELECT mdp FROM joueurs WHERE mdp = :mdp_code");
            $stmt->bindParam(":mdp_code", $mdp_code);
            $stmt->execute();
            $bdd_mdp = $stmt->fetchAll();

            if(count($bdd_mdp) != 0 && count($bdd_pseudo) != 0){
                $stmt = $pdo->prepare("SELECT * FROM joueurs WHERE pseudo = :pseudo");
                $stmt->bindParam(":pseudo", $pseudo);
                $stmt->execute();
                $bdd_statut = $stmt->fetchAll();
                $_SESSION["pseudo"] = $pseudo;
                $_SESSION["statut"] = $bdd_statut[0]["statut"];
                $_SESSION["progres"] = $bdd_statut[0]["progres"];
                header('Location:choix_enigme.php');
            }
            $pdo=null;
            afficheFormulaire("mdp ou pseudo inccorect");
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
        <title>Connexion_TRESOR</title>
        <link rel="stylesheet" href="connexion.css">
    </head>
    <body>
      <h1>BIENVENUE SUR LA PAGE DE CONNEXION </h1>
      <h2> sur cette page vous pouvez vous connecter </h2>
            <?php choix_affichage(); ?>
            
    </body>
</html>