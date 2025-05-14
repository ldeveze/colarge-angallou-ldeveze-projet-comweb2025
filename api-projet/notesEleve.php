<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
// 🔐 Autoriser les appels depuis n'importe quelle origine (React local)
header("Access-Control-Allow-Origin: *");

// 🔐 Autoriser les méthodes HTTP
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

// 🔐 Autoriser les headers personnalisés
header("Access-Control-Allow-Headers: Content-Type");

// 🔁 Si c'est une pré-requête OPTIONS (automatique), on termine ici :
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


function envoiJSON($tab){
    header('Content-Type: application/json');
    echo json_encode($tab, JSON_UNESCAPED_UNICODE);
}

function recupNotes() {
    // Connexion BDD
    $host = 'localhost';		
    $dbname = 'ldeveze';
    $username = 'ldeveze';
    $password = 'PotDeFleurBleu2!';

    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    } catch(Exception $e) {
        die('Erreur : '. $e->getMessage());
    }

    // Vérifier que le paramètre pseudo existe
    if (!isset($_GET['pseudo'])) {
        envoiJSON(["error" => "Paramètre 'pseudo' manquant"]);
        return;
    }

    $pseudo = $_GET['pseudo'];

    // Requête pour récupérer les notes
    $requete = "
    SELECT 
        n.libelle, 
        n.valeur, 
        m.nom AS matiere,
        CONCAT(p.prenom, ' ', p.nom) AS professeur
    FROM note n
    JOIN eleve e ON e.id = n.id_eleve
    JOIN matiere m ON m.id = n.id_matiere
    JOIN prof p ON p.id_matiere = m.id
    WHERE e.pseudo = ?
";


    $stmt = $bdd->prepare($requete);
    $stmt->execute([$pseudo]);
    $tableau = $stmt->fetchAll(PDO::FETCH_ASSOC);

    envoiJSON($tableau);
}

recupNotes();
?>
