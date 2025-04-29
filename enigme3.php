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
    echo "<p>Des mots vont apparaître à l&apos;écran, observez bien et essayer de retenir le plsu d'informations possible, cela vous sera utile par la suite.</p>\n";
    echo "<p><strong id='condition'>Conditions de réussite:</strong> Répondez aux questions correctement pour arriver à la prochaine énigme.</p>\n";
    echo "<br>\n";
    echo "<span>Bonne chance ! (oui encore)</span>\n";
    echo "<br><br><br>\n";
    echo "<a id='lien1' href='enigme3.php?observation=0'>Commencer </a>\n";
    echo "<br><br><br><br>\n";
    echo "<span>Si vous voulez retourner au choix des énigmes, cliquez ici <a id='lien2' href='choix_enigme.php'>Choix</a></span>\n";
}

function chrono($duree, $etape, $indice_mot_question){
    echo "<script>decompte($duree);</script>\n";
    header( "refresh:$duree; url=enigme3.php?reponse=$etape&indice=$indice_mot_question");
}

function affichage_connectee_observation(){

    /* variables */
    
    $tab_mot = ["bateau", "carte", "mer", "pirate", "diamant", "serpent", "perroquet", "sable", "feuille", "chat", "sac", "eau", "bois", "arbre", "nuage", "vent", "verre", "personne", "chaine", "invocation", "immeuble", "orange", "souris", "passion", "ascenseur", "magicien", "coussin", "ordinateur", "science", "glace", "direction", "pouvoir", "investigation", "aurore", "chargeur", "crystal", "situation", "architecture", "papillon", "mirroir", "image", "tapis", "balai", "couverture", "comfortable", "cuisine", "fleur", "blob", "ombre", "silhouette"];
    $long = count($tab_mot);
    $indice_mot_question = rand(0, $long-1);
    $temps = 10;

    /* affichage du bord haut */
    
    echo "<header>\n";
    echo "<span id='temps'>Temps: <span id='chrono'>"."$temps".".00"."</span></span>\n";
    echo "<strong id='bord'>";
    for($i=0; $i<52; $i++){
        echo "_";
    }
    echo "</strong>\n";
    echo "</header>\n";

    /* boucle d'affichage des mots */
    
    for($i=0; $i<8; $i++){

        /* étape 0 */
        
        if($_GET["observation"] == 0){
            if($i % 2 != 1){
                echo "<p id='mots'>";
                for($j=0; $j<3; $j++){
                    $indice = rand(0, $long-1);
                    $mot = $tab_mot[$indice];
                    if($j != 2){
                        echo "$mot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    else{
                        echo "$mot</p>\n";
                        if($i != 6){
                            echo "<br>\n";
                        }
                    }
                }
            }
        }
        else{

            /* étape 1 */
            
            if($_GET["observation"] == 1){
                echo "<p id='mots'>";
                for($j=0; $j<3; $j++){
                    $indice = rand(0, $long-1);
                    $mot = $tab_mot[$indice];
                    if($j != 2){
                        echo "$mot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    else{
                        echo "$mot</p>\n";
                        if($i != 7){
                            echo "<br>\n";
                        }
                    }
                }
            }
            else{

                /* étape 2 */
                
                if($_GET["observation"] == 2){
                    echo "<p id='mots'>";
                    for($j=0; $j<3; $j++){
                        $indice = rand(0, $long-1);
                        $mot = $tab_mot[$indice];
                        if($j != 2){
                            echo "$mot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        }
                        else{
                            echo "$mot</p>\n";
                            if($i != 7){
                                echo "<br>\n";
                            }
                        }
                    }
                }
            }
        }
    }

    /* affichage du bord bas */
    
    echo "<footer>\n";
    echo "<strong id='bord'>";
    for($i=0; $i<52; $i++){
        echo "_";
    }
    echo "</strong>\n";
    echo "</footer>\n";

    /* appel du chrono */
    
    chrono(10, $_GET["observation"], $indice_mot_question);
}

function affichage_connectee_reponse(){
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
                if(!isset($_GET["observation"]) && !isset($_GET["question"])){
                    affichage_connectee();
                }
                else{
                    if(isset($_GET["observation"])){
                        affichage_connectee_observation();
                    }
                    else{
                        affichage_connectee_reponse();
                    }
                }
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
        <link rel="stylesheet" href="enigme3.css">
        <script src="enigme3.js"></script>
    </head>
    <body>

        <div id="contenu">
             <?php choix_affichage(); ?>
        </div>
        
    </body>
</html>