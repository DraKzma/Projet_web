<?php

session_start();
$_SESSION["pseudo"] = NULL;
$_SESSION["status"] = NULL;
$_SESSION["progres"] = NULL;
session_destroy();

if(!isset($_GET["logout"])){
    echo "<h3>Une erreure innatendue s'est produite, les devs devraient vraiment apprendre à coder..</h3>\n";
}
else{
    if($_GET["logout"] == "accueil"){
        header("Location:accueil.html");
    }
    else{
        if($_GET["logout"] == "bravo"){
            header("Location:bravo.html");
        }
    }
}

?>