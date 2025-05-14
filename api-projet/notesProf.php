<?php
// Autorise toutes les origines pour les requêtes CORS
header("Access-Control-Allow-Origin: *");
// Autorise les méthodes GET et OPTIONS
header("Access-Control-Allow-Methods: GET, OPTIONS");
// Autorise l'en-tête Content-Type
header("Access-Control-Allow-Headers: Content-Type");

// Répond à la requête OPTIONS si elle est envoyée (CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Indique que la réponse sera en JSON
header("Content-Type: application/json");

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=ldeveze;charset=utf8', 'ldeveze', 'PotDeFleurBleu2!');

// Récupère l'ID du professeur passé en paramètre GET
$idProf = $_GET['idProf'] ?? null;

// Si l'ID est manquant, renvoie une erreur JSON
if (!$idProf) {
    echo json_encode(['error' => "Paramètre 'idProf' manquant"]);
    exit();
}

// Prépare une requête SQL pour récupérer les notes données par ce professeur
$stmt = $pdo->prepare("
    SELECT
        e.prenom,                         -- Prénom de l'élève
        e.nom,                            -- Nom de l'élève
        c.libelle AS classe,              -- Libellé de la classe
        m.nom AS matiere,                 -- Nom de la matière
        n.libelle,                        -- Libellé de l'évaluation
        n.valeur                          -- Valeur de la note
    FROM note n
    JOIN eleve e ON n.id_eleve = e.id
    JOIN classe c ON e.id_classe = c.id
    JOIN matiere m ON n.id_matiere = m.id
    JOIN prof p ON p.id_matiere = m.id
    WHERE p.id = ?
");

// Exécute la requête avec l'ID du professeur
$stmt->execute([$idProf]);
// Récupère toutes les notes correspondant
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Renvoie les notes au format JSON
echo json_encode($notes);
