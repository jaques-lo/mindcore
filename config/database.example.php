<?php
// Copie este arquivo para database.php e preencha com seus dados
// Configure as variáveis de ambiente no seu servidor ou no arquivo .env

$host     = getenv('DB_HOST') ?: 'localhost';
$port     = getenv('DB_PORT') ?: '5432';
$dbname   = getenv('DB_NAME') ?: 'nome_do_banco';
$user     = getenv('DB_USER') ?: 'usuario';
$password = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
