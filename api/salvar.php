<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/database.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
    exit;
}

$humor = filter_var($data['humor'] ?? 0, FILTER_VALIDATE_INT);
$estresse = filter_var($data['estresse'] ?? 0, FILTER_VALIDATE_INT);
$sono = filter_var($data['sono'] ?? 0, FILTER_VALIDATE_INT);

try {
    $sql = "INSERT INTO respostas (humor, estresse, sono) VALUES (:humor, :estresse, :sono)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':humor' => $humor,
        ':estresse' => $estresse,
        ':sono' => $sono
    ]);
    
    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Dados salvos!']);
} catch(PDOException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro no banco']);
}
?>
