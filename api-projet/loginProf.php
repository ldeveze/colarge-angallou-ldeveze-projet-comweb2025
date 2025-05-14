<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

header("Content-Type: application/json");

$pdo = new PDO('mysql:host=localhost;dbname=ldeveze;charset=utf8', 'ldeveze', 'PotDeFleurBleu2!');
$data = json_decode(file_get_contents("php://input"), true);

$pseudo = $data['pseudo'] ?? '';
$motdepasse = $data['motdepasse'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM prof WHERE pseudo = ? AND motdepasse = ?");
$stmt->execute([$pseudo, $motdepasse]);
$prof = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($prof ? ['success' => true, 'pseudo' => $pseudo, 'id' => $prof['id']] : ['success' => false, 'message' => 'Identifiants incorrects']);
