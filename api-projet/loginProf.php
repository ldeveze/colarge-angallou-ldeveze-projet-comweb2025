<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

header("Content-Type: application/json");

$pdo = new PDO('mysql:host=localhost;dbname=college;charset=utf8', 'root', '');
$data = json_decode(file_get_contents("php://input"), true);

$pseudo = $data['pseudo'] ?? '';
$motdepasse = $data['motdepasse'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM prof WHERE pseudo = ? AND motdepasse = ?");
$stmt->execute([$pseudo, $motdepasse]);
$prof = $stmt->fetch(PDO::FETCH_ASSOC);

if ($prof) {
    echo json_encode(['success' => true, 'pseudo' => $pseudo, 'id' => $prof['id']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Identifiants incorrects']);
}
