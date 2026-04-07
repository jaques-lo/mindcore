<?php
require_once 'config/database.php';

$sql = "SELECT * FROM respostas ORDER BY data DESC";
$stmt = $pdo->query($sql);
$respostas = $stmt->fetchAll();
$total = count($respostas);

// Médias
$mediaHumor = $total > 0 ? array_sum(array_column($respostas, 'humor')) / $total : 0;
$mediaEstresse = $total > 0 ? array_sum(array_column($respostas, 'estresse')) / $total : 0;
$mediaSono = $total > 0 ? array_sum(array_column($respostas, 'sono')) / $total : 0;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>MindCore - Admin</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <div class="container">
        <h1>Dashboard Admin</h1>
        <div class="stats-grid">
            <div class="stat-card"><h3>Total</h3><div class="value"><?= $total ?></div></div>
            <div class="stat-card"><h3>Humor</h3><div class="value"><?= round($mediaHumor, 1) ?></div></div>
            <div class="stat-card"><h3>Estresse</h3><div class="value"><?= round($mediaEstresse, 1) ?></div></div>
            <div class="stat-card"><h3>Sono</h3><div class="value"><?= round($mediaSono, 1) ?></div></div>
        </div>

        <div class="actions"><button class="refresh-btn" onclick="location.reload()">Atualizar</button></div>

        <div class="table-container">
            <table>
                <thead><tr><th>ID</th><th>Humor</th><th>Estresse</th><th>Sono</th><th>Data</th></tr></thead>
                <tbody>
                <?php foreach($respostas as $r): ?>
                    <tr>
                        <td><?= $r['id'] ?></td>
                        <td><span class="badge"><?= $r['humor'] ?></span></td>
                        <td><span class="badge"><?= $r['estresse'] ?></span></td>
                        <td><span class="badge"><?= $r['sono'] ?></span></td>
                        <td><?= date('d/m/Y H:i', strtotime($r['data'])) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>