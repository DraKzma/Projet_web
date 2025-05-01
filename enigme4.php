<?php

session_start();
include "connex.inc.php";

$code1 = "097";
$code2 = "25116";
$code3 = "1002483";

function ajout_niveau(){
    $pseudo = $_SESSION["pseudo"];
    $progres = $_SESSION["progres"];
    if($progres < 4){
        $base = "tresor.sqlite";
        $pdo = connex($base);
        $stmt = $pdo->prepare("UPDATE joueurs SET progres = 4 WHERE pseudo = :pseudo");
        $stmt->bindParam(":pseudo", $pseudo);
        $stmt->execute();
        $_SESSION["progres"] = 4;
    }
    header("Location:enigme4.php");
}

function affichage_non_connectee(){
    echo "<h3>Vous devez vous connecter pour jouer à notre chasse au trésor <strong>INCROYABLE</strong></h3>\n";
    echo "ça se passe ici <a href='connexion.php'>Se connecter</a>\n";
}

function affichage_bloquee(){
    echo "<h3>Alors il se trouve que vous n&apos;avez pas encore débloqué cette énigme, c&apos;est bien <strong>DOMMAGE</strong></h3>\n";
    echo "Pour retournez au choix des énigmes c&apos;est par ici <a href='choix_enigme.php'>Choix</a>\n";
}

function affichage_connectee_etape1(){
    echo "<h1>Enigme N°4</h1>\n";
    if(isset($_POST["etape3"])){
        echo "<h3 class='rouge'>C&apos;est bizzare, j&apos;ai l&apos;impression d&apos;avoir déjà été ici..</h3>\n";
    }
    echo "<h3>Bon on vas pas vous mentir, celle-là est vraiment pas compliquée. En même temps, c&apos;est pas facile de trouver de bonnes idées pour faire des énigmes vous savez? Bon alors vous allez me dire bah fallait pas choisir ça comme projet m&apos;enfin.. Bref. Y&apos;a des cases de couleurs faut trouver un code rien de bien méchant quoi. On s&apos;est même pas pris la tête à faire en sorte que les codes soient aléatoires. Ah oui par contre, il y&apos;a un bug un peu bizzare qui se produit généralement vers la fin, bon, vous verrez bien par vous même de toute façon.</h3>\n";
    echo "<h2>Bonne chance !</h2>\n";
    echo "<p class='commentaires'><em>Ah oui donc là je suis supposé afficher les cases de couleurs..</em></p>\n";
    echo "<br>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_rouge'>9</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;et d&apos;une !</p>\n";
    echo "<br><br>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_bleue'>7</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_verte'>0</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;et voilà les deux autres.</p>\n";
    echo "<br><br>\n";
    echo "<p id='commentaires'>Bon et alors là je dois vous donner l&apos;ordre, ben oui parce que sinon vous aller avoir du mal à rentre le bon code. Sachez que dans les étapes qui suivent, ça ne sera pas aussi facile que cela, mais pour le moment, voici l&apos;ordre: <span class='vert'>Vert</span> <span class='rouge'>Rouge</span> <span class='bleu'>Bleu</span>\n";
    echo "<br>\n";
    echo "<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."'method='post'>\n";
    if(!isset($_POST["etape1"])){
        echo "<label><strong>Entrez le code: </strong><input type='text' name='etape1' id='code' required='required' maxlength='3'></label>\n";
    }
    else{
        echo "<label><strong>Entrez le code: </strong><input type='text' name='etape1' id='code' required='required' value='Code invalide.' maxlength='3'></label>\n";
    }
    echo "<br><br>\n";
    echo "<button id='envoi' type='submit' name='envoi'>Valider</button>\n";
    echo "</form>\n";
    echo "<br><br><br>\n";
    echo "<span>Si vous voulez retourner au choix des énigmes, cliquez ici <a id='lien2' href='choix_enigme.php'>Choix</a></span>\n";
}

function affichage_connectee_etape2(){
    echo "<h3>Bon je vois que vous savez suivre des consignes c&apos;est bien bravo. On va maintenant faire la même chose mais avec 5 couleurs au lieu de 3, pas très compliqué, n&apos;est ce pas?</h3>\n";
    echo "<br>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_bleue'>2</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Oh, en voilà une !</p>\n";
    echo "<br><br>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_jaune'>5</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tiens, une nouvelle couleur..</p>\n";
    echo "<br>\n";
    echo "<p id='commentaires'>Et ducoup les 3 dernières elles sont où?</p>\n";
    echo "<br><br><br>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;&nbsp;<span id='case_rouge'>1</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_rose'>6</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_verte'>1</span>&nbsp;&nbsp;&nbsp;&nbsp;Il suffisait de demander !</p>\n";
    echo "<br><br>\n";
    echo "<p id='commentaires'>Pour ce qui est de l&apos;ordre les 3 premières sont les couleurs du drapeau de la Roumanie et pour les 2 dernières.. euh, alors ça va être drôle mais j&apos;ai oublié. C&apos;est pas très grave, il y&apos;a que deux possibilités de toutes façon. Essayez l&apos;une puis l&apos;autre et vous verrez bien ce que ça donne !</p>\n";
    echo "<p id='commentaires'>PS: si ça marche pas là je peux plus rien pour vous c&apos;est vraiment pas dur pourtant.</p>\n";
    echo "<br>\n";
    echo "<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."'method='post'>\n";
    if(!isset($_POST["etape2"])){
        echo "<label><strong>Entrez le code: </strong><input type='text' name='etape2' id='code' required='required' maxlength='5'></label>\n";
    }
    else{
        echo "<label><strong>Entrez le code: </strong><input type='text' name='etape2' id='code' required='required' value='Code invalide.' maxlength='5'></label>\n";
    }
    echo "<br><br>\n";
    echo "<button id='envoi' type='submit' name='envoi'>Valider</button>\n";
    echo "</form>\n";
}

function affichage_connectee_etape3(){
    echo "<h3>Bien joué ! Ceci est l&apos;avant dernière étape. Comme dit le proverbe, plus on est de fou, plus on ris. C&apos;est pourquoi j&pos;ai décidé de passer à 7 cases de couleur différentes cette fois. Ah oui et aussi ##$!ù??UNKNOWN#/\ERROR)(--#_ mais ne le dites à personne d&apos;accord?</h3>\n";
    echo "<br>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_violette'>0</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_orange'>4</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ouah, Deux nouvelles couleurs ! J&apos;adore le violet.</p>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mince.. la case orange semble cassée.</p>\n";
    echo "<h3 id='indications'>Je me demande si il n&apos;y a pas un autre moyen de savoir quel numéro se cache derrière l&apos;orange..</h3>\n";
    echo "<br>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;<span id='case_rouge'>8</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_rose'>3</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_bleue'>0</span>&nbsp;&nbsp;&nbsp;<span id='case_verte'>1</span>&nbsp;&nbsp;&nbsp;En voilà quatre autres.</p>\n";
    echo "<br>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_jaune'>2</span></p>\n";
    echo "<p id='commentaires'>La dernière case est là, voici une petite énigme pour vous:</p>\n";
    echo "<ul id='enigme'>\n";
    echo "<li>Le cinquième numéro est la case <span class='orange'>Orange</span></li>\n";
    echo "<li>Les cases <span class='vert'>Verte</span> et <span class='violet'>Violette</span> sont situées sur une position impaire</li>\n";
    echo "<li>La case <span class='rouge'>Rouge</span> est située avant la case <span class='rose'>Rose</span></li>\n";
    echo "<li>La case <span class='jaune'>Jaune</span> est à une position paire, elle est située après la <span class='vert'>Verte</span> et la <span class='violet'>Violette</span></li>\n";
    echo "<li>La position de la case <span class='rouge'>Rouge</span> est égale à la position de la <span class='orange'>Orange</span> plus celle de la <span class='vert'>Verte</span></li>\n";
    echo "<li>La case <span class='bleu'>Bleue</span> n&apos;a rien à vous dire</li>\n";
    echo "<li class='rouge'>Don&apos;t fail or else..</li>\n";
    echo "</ul>\n";
    echo "<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."'method='post'>\n";
    echo "<label><strong>Entrez le code: </strong><input type='text' name='etape3' id='code' required='required' maxlength='7'></label>\n";
    echo "<br><br>\n";
    echo "<button id='envoi' type='submit' name='envoi'>Valider</button>\n";
    echo "</form>\n";
}

function affichage_connectee_etape4(){
    echo "<h3>Vous y êtes c&apos;est la dernière<span class='bug'>####Y\YOU_ARE_MINE!%%w</span> Je pense que c&apos;est bien asser dur comme ça <span class='bug'>///!?DON&apos;T_HIDE;,;$$</span> le nombre de cases ne change pas, c&apos;est bien asser compliqué comme ça.<span class='bug'>--|STOP_?,#</span></h3>\n";
    echo "<br>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;<span id='case_rouge'>8</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_orange'>9</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_verte'>9</span>&nbsp;&nbsp;&nbsp;<span id='case_violette'>9</span>&nbsp;&nbsp;&nbsp;Mais qu&apos;est ce qu&apos;il se passe?</p>\n";
    echo "<br>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a id='case_lien' href='enigme5.php?update=1'>5</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_bleue'>3</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='bug'>((I_WILL??_FIND~à°_YOU//::?ù</span></p>\n";
    echo "<br><br>\n";
    echo "<p id='commentaires'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La case rose paraît bizzare, vous ne trouvez pas?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id='case_jaune'>0</span>&nbsp;&nbsp;&nbsp;Ah, voilà la dernière.</p>\n";
    echo "<span class='bug'>##{]}==YOU_C?ANNOT_ESCAPEcc%***##[)(</span>\n";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='bug'>&&&~I_H!ATE_YOU¡!§vF^$#099</span>\n";
    echo "<br><br>\n";
    echo "<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."'method='post'>\n";
    echo "<label><strong>Entrez le code: </strong><input type='text' name='etape3' id='code' required='required' readonly='readonly' value='##BL!OCK?ED993//%;;T'></label>\n";
    echo "<br><br>\n";
    echo "<input id='envoi' type='button' name='envoi' value='Valider'></button>\n";
    echo "</form>\n";
    echo "<br>\n";
    echo "<p id='commentaires'>Super, le form est complètement bugué. On fait comment maintenant?</p>\n";
    echo "<br><br><br>\n";
    echo "<span class='bug'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>\n";
    echo "<span class='bug'>-->I__SEE??_YOU##&M&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>\n";
    echo "<span class='bug'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>\n";
    echo "<br>\n";
    echo "<span class='bug'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>\n";
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
            if($_SESSION["progres"] < 4){
                affichage_bloquee();
            }
            else{
                if((isset($_POST["etape1"]) && $_POST["etape1"] == $GLOBALS['code1']) || (isset($_POST["etape2"]) && $_POST["etape2"] != $GLOBALS['code2'])){
                    affichage_connectee_etape2();
                }
                else{
                    if(isset($_POST["etape2"]) && $_POST["etape2"] == $GLOBALS['code2']){
                        affichage_connectee_etape3();
                    }
                    else{
                        if(isset($_POST["etape3"]) && $_POST["etape3"] == $GLOBALS['code3']){
                            affichage_connectee_etape4();
                        }
                        else{
                            affichage_connectee_etape1();
                        }
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
        <title>Enigme4</title>
        <link rel="stylesheet" href="enigme4.css">
    </head>
    <body>

        <div id="contenu">
            <?php choix_affichage(); ?>
        </div>
        
    </body>
</html>