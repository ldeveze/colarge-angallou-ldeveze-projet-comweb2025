<?php 

function envoiJSON($tab){
    header('Content-Type: application/json');
    //print_r($tab);
    $json = json_encode($tab, JSON_UNESCAPED_UNICODE);
    echo $json;
}

function recupNotes() {
    //variables de connexion
    $host = 'localhost';		
    $dbname = 'college';
    $username = 'root';
    $password = '';
    //tentative de connexion à la base de donnée
    try {
        $bdd = new PDO('mysql:host='. $host .';dbname='. $dbname .';charset=utf8',
        $username, $password);

    } catch(Exception $e) {
        // Si erreur, tout arrêter
        die('Erreur : '. $e->getMessage());
    }
    //préparation de la requête
    $requete = "select * from eleve";
    //requête auprès de la base
    $resultat = $bdd->query($requete);
    // On récupère tout dans la variable tableau
    $tableau = $resultat->fetchall(); 
    print_r($tableau);
    //affichage du tableau - c'est un tableau de tableau
    //print_r($tableau); 
    // foreach($tableau as $cellule){
    //     echo $cellule['ville_nom']."   ".$cellule['ville_code_postal']."<br>";
    // } 
}
recupNotes();

?>  