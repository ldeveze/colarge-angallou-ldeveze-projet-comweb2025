<?php 
include("api.php");
if (empty($_GET)) {     //connexion sans paramètre
    header("Content-Type: text/html; charset=UTF-8");
    echo "page d'accueil";
    print_r($_GET);
}
else {
    $donnees = recupNotes($_GET['url']);
    envoiJSON($donnees);
}
?>