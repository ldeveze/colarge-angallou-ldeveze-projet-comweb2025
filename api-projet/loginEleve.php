<?php

// ✅ En-têtes CORS — doivent être tout en haut (aucun espace ou ligne avant)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// ✅ Gérer la requête préliminaire envoyée par le navigateur
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// ✅ Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=ldeveze;charset=utf8', 'ldeveze', 'PotDeFleurBleu2!');

// ✅ Lecture du corps JSON envoyé par React
$data = json_decode(file_get_contents('php://input'), true);
$pseudo = $data['pseudo'] ?? '';
$motdepasse = $data['motdepasse'] ?? '';

// ✅ Vérifier les identifiants
$stmt = $pdo->prepare("SELECT * FROM eleve WHERE pseudo = ? AND motdepasse = ?");
$stmt->execute([$pseudo, $motdepasse]);
$eleve = $stmt->fetch(PDO::FETCH_ASSOC);

// ✅ Retourner la réponse JSON
header('Content-Type: application/json');
if ($eleve) {
    echo json_encode(['success' => true, 'pseudo' => $pseudo]);
} else {
    echo json_encode(['success' => false, 'message' => 'Identifiants incorrects']);
}
