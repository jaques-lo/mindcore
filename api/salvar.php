<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// salvar.php está em /mindcore/api/ → config está em /mindcore/config/
require_once __DIR__ . '/../config/database.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
    exit;
}

$humor    = filter_var($data['humor']    ?? null, FILTER_VALIDATE_INT);
$estresse = filter_var($data['estresse'] ?? null, FILTER_VALIDATE_INT);
$sono     = filter_var($data['sono']     ?? null, FILTER_VALIDATE_INT);

if ($humor === false || $estresse === false || $sono === false) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Valores inválidos']);
    exit;
}

// Garante range 0–10
$humor    = max(0, min(10, $humor));
$estresse = max(0, min(10, $estresse));
$sono     = max(0, min(10, $sono));

try {
    $sql  = "INSERT INTO respostas (humor, estresse, sono, data) VALUES (:humor, :estresse, :sono, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':humor' => $humor, ':estresse' => $estresse, ':sono' => $sono]);
    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Dados salvos!']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro no banco: ' . $e->getMessage()]);
}