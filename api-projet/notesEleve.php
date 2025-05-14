<?php
// Autorise les requêtes CORS pour toutes origines
header("Access-Control-Allow-Origin: *");
// Autorise les méthodes HTTP POST, GET, OPTIONS
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// Autorise l'en-tête Content-Type
header("Access-Control-Allow-Headers: Content-Type");

// Répond à la requête préliminaire OPTIONS si elle est envoyée
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Indique que la réponse sera au format JSON
header("Content-Type: application/json");

// Fonction pour envoyer un tableau encodé en JSON avec support Unicode
function envoiJSON($tab) {
    echo json_encode($tab, JSON_UNESCAPED_UNICODE);
}

// Tente de se connecter à la base de données et capture les erreurs
try {
    $bdd = new PDO('mysql:host=localhost;dbname=ldeveze;charset=utf8', 'ldeveze', 'PotDeFleurBleu2!');
} catch(Exception $e) {
    // En cas d'erreur, renvoie un message d'erreur JSON et arrête le script
    envoiJSON(["error" => "Connexion BDD échouée : " . $e->getMessage()]);
    exit();
}

// Récupère le paramètre 'pseudo' depuis l'URL (GET)
$pseudo = $_GET['pseudo'] ?? null;

// Si aucun pseudo n'est fourni, renvoie une erreur
if (!$pseudo) {
    envoiJSON(["error" => "Paramètre 'pseudo' manquant"]);
    exit();
}

// Requête SQL pour récupérer les notes, matières et professeurs de l'élève
$requete = "
    SELECT
        n.libelle,                       -- Libellé de l'évaluation (ex: DS1)
        n.valeur,                        -- Valeur numérique de la note
        m.nom AS matiere,               -- Nom de la matière
        CONCAT(p.prenom, ' ', p.nom) AS professeur  -- Nom complet du professeur
    FROM note n
    JOIN eleve e ON e.id = n.id_eleve
    JOIN matiere m ON m.id = n.id_matiere
    JOIN prof p ON p.id_matiere = m.id
    WHERE e.pseudo = ?
";

// Prépare et exécute la requête avec le pseudo fourni
$stmt = $bdd->prepare($requete);
$stmt->execute([$pseudo]);
// Récupère toutes les notes sous forme de tableau associatif
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Renvoie les notes sous forme JSON
envoiJSON($notes);
