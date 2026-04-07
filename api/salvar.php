<?php
// Define que a resposta desse arquivo será um JSON (padrão para APIs)
header('Content-Type: application/json');

// Permite que qualquer endereço (origem) acesse essa API (importante para evitar erros de CORS)
header('Access-Control-Allow-Origin: *');

// Define que esta API só aceita o método de envio POST
header('Access-Control-Allow-Methods: POST');

// Permite que o cabeçalho 'Content-Type' seja enviado na requisição
header('Access-Control-Allow-Headers: Content-Type');

// Importa a conexão com o banco de dados que configuramos no database.php
require_once '../config/database.php';

// Lê o "corpo" da requisição (o JSON enviado pelo JS) e transforma em um array do PHP
$data = json_decode(file_get_contents('php://input'), true);

// Se não houver dados ou o JSON estiver quebrado, encerra com erro
if (!$data) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
    exit;
}

// Filtra e valida se os valores recebidos são números inteiros (Segurança contra dados maliciosos)
// O '?? 0' garante que, se o campo não existir, o valor padrão será zero
$humor = filter_var($data['humor'] ?? 0, FILTER_VALIDATE_INT);
$estresse = filter_var($data['estresse'] ?? 0, FILTER_VALIDATE_INT);
$sono = filter_var($data['sono'] ?? 0, FILTER_VALIDATE_INT);

try {
    // Prepara a consulta SQL para inserir os dados na tabela 'respostas'
    // Usamos :nomes (placeholders) para evitar ataques de SQL Injection
    $sql = "INSERT INTO respostas (humor, estresse, sono) VALUES (:humor, :estresse, :sono)";
    $stmt = $pdo->prepare($sql);
    
    // Executa a gravação substituindo os placeholders pelos valores reais
    $stmt->execute([
        ':humor' => $humor,
        ':estresse' => $estresse,
        ':sono' => $sono
    ]);
    
    // Se chegar aqui, deu tudo certo e responde ao JavaScript com sucesso
    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Dados salvos!']);
    
} catch(PDOException $e) {
    // Caso ocorra algum erro no banco (tabela inexistente, etc), cai aqui
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro no banco']);
}
?>