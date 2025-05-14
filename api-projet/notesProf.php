<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

header("Content-Type: application/json");

$pdo = new PDO('mysql:host=localhost;dbname=ldeveze;charset=utf8', 'ldeveze', 'PotDeFleurBleu2!');
$idProf = $_GET['idProf'] ?? null;

if (!$idProf) {
    echo json_encode(['error' => "Paramètre 'idProf' manquant"]);
    exit();
}

$stmt = $pdo->prepare("
    SELECT
        e.prenom,
        e.nom,
        c.libelle AS classe,
        m.nom AS matiere,
        n.libelle,
        n.valeur
    FROM note n
    JOIN eleve e ON n.id_eleve = e.id
    JOIN classe c ON e.id_classe = c.id
    JOIN matiere m ON n.id_matiere = m.id
    JOIN prof p ON p.id_matiere = m.id
    WHERE p.id = ?
");

$stmt->execute([$idProf]);
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($notes);
