<?php
// Autorise toutes les origines pour les requêtes CORS
header("Access-Control-Allow-Origin: *");
// Autorise les méthodes POST et OPTIONS
header("Access-Control-Allow-Methods: POST, OPTIONS");
// Autorise l'en-tête Content-Type
header("Access-Control-Allow-Headers: Content-Type");

// Répond à la requête préliminaire (OPTIONS) pour CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Définit la réponse comme JSON
header("Content-Type: application/json");

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=ldeveze;charset=utf8', 'ldeveze', 'PotDeFleurBleu2!');

// Récupère les données JSON envoyées par le client
$data = json_decode(file_get_contents("php://input"), true);

// Extrait le pseudo et le mot de passe, avec valeurs par défaut vides
$pseudo = $data['pseudo'] ?? '';
$motdepasse = $data['motdepasse'] ?? '';

// Prépare une requête SQL pour chercher un professeur avec ces identifiants
$stmt = $pdo->prepare("SELECT * FROM prof WHERE pseudo = ? AND motdepasse = ?");
// Exécute la requête
$stmt->execute([$pseudo, $motdepasse]);
// Récupère les données du professeur si elles existent
$prof = $stmt->fetch(PDO::FETCH_ASSOC);

// Renvoie une réponse JSON indiquant si l'authentification a réussi ou échoué
echo json_encode($prof ? ['success' => true, 'pseudo' => $pseudo, 'id' => $prof['id']] : ['success' => false, 'message' => 'Identifiants incorrects']);
