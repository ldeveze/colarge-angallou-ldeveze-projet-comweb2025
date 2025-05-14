<?php
// Autorise toutes les origines pour les requêtes CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
// Autorise les méthodes HTTP POST, GET et OPTIONS
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// Autorise l'en-tête Content-Type dans les requêtes
header("Access-Control-Allow-Headers: Content-Type");

// Si la requête est de type OPTIONS (prévol CORS), on y répond immédiatement avec succès
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Définit le type de réponse comme du JSON
header('Content-Type: application/json');

// Connexion à la base de données MySQL avec PDO
$pdo = new PDO('mysql:host=localhost;dbname=ldeveze;charset=utf8', 'ldeveze', 'PotDeFleurBleu2!');

// Récupère et décode les données JSON envoyées par le client
$data = json_decode(file_get_contents('php://input'), true);

// Récupère le pseudo et le mot de passe (valeurs par défaut : chaîne vide)
$pseudo = $data['pseudo'] ?? '';
$motdepasse = $data['motdepasse'] ?? '';

// Prépare une requête SQL pour chercher un élève avec ces identifiants
$stmt = $pdo->prepare("SELECT * FROM eleve WHERE pseudo = ? AND motdepasse = ?");
// Exécute la requête avec les valeurs reçues
$stmt->execute([$pseudo, $motdepasse]);
// Récupère le premier résultat (ou false si aucun résultat)
$eleve = $stmt->fetch(PDO::FETCH_ASSOC);

// Renvoie une réponse JSON selon que l'authentification a réussi ou échoué
echo json_encode($eleve ? ['success' => true, 'pseudo' => $pseudo] : ['success' => false, 'message' => 'Identifiants incorrects']);
