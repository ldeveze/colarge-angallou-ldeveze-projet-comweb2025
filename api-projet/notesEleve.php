<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

header("Content-Type: application/json");

function envoiJSON($tab) {
    echo json_encode($tab, JSON_UNESCAPED_UNICODE);
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=ldeveze;charset=utf8', 'ldeveze', 'PotDeFleurBleu2!');
} catch(Exception $e) {
    envoiJSON(["error" => "Connexion BDD échouée : " . $e->getMessage()]);
    exit();
}

$pseudo = $_GET['pseudo'] ?? null;

if (!$pseudo) {
    envoiJSON(["error" => "Paramètre 'pseudo' manquant"]);
    exit();
}

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
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

envoiJSON($notes);
