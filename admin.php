<?php
require_once 'config/database.php';

$sql = "SELECT * FROM respostas ORDER BY data DESC";
$stmt = $pdo->query($sql);
$respostas = $stmt->fetchAll();
$total = count($respostas);

$mediaHumor    = $total > 0 ? round(array_sum(array_column($respostas, 'humor'))    / $total, 1) : 0;
$mediaEstresse = $total > 0 ? round(array_sum(array_column($respostas, 'estresse')) / $total, 1) : 0;
$mediaSono     = $total > 0 ? round(array_sum(array_column($respostas, 'sono'))     / $total, 1) : 0;

function badgeClass($val, $tipo) {
    if ($tipo === 'estresse') {
        if ($val <= 3) return 'bom';
        if ($val <= 6) return 'medio';
        return 'ruim';
    }
    if ($val >= 7) return 'bom';
    if ($val >= 4) return 'medio';
    return 'ruim';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCore · Admin</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="icon" type="image/x-icon" href="assets/imagens/mindcore-icon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>

    <div class="bg-grid"></div>

    <header class="admin-header">
        <div class="header-left">
            <div class="logo-mark">M</div>
            <div>
                <span class="logo-text">MindCore</span>
                <span class="admin-badge">Admin</span>
            </div>
        </div>
        <div class="header-right">
            <a href="index.php" class="btn-back">← Ver formulário</a>
            <button class="btn-refresh" onclick="location.reload()">↻ Atualizar</button>
        </div>
    </header>

    <main class="admin-main">

        <div class="page-title">
            <h1>Dashboard</h1>
            <p><?= $total ?> resposta<?= $total !== 1 ? 's' : '' ?> coletada<?= $total !== 1 ? 's' : '' ?></p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Total</span>
                    <span class="stat-value"><?= $total ?></span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Humor médio</span>
                    <span class="stat-value <?= badgeClass($mediaHumor, 'humor') ?>"><?= $mediaHumor ?></span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Estresse médio</span>
                    <span class="stat-value <?= badgeClass($mediaEstresse, 'estresse') ?>"><?= $mediaEstresse ?></span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Sono médio</span>
                    <span class="stat-value <?= badgeClass($mediaSono, 'sono') ?>"><?= $mediaSono ?></span>
                </div>
            </div>
        </div>

        <?php if ($total > 0): ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>🙂 Humor</th>
                        <th>⚡ Estresse</th>
                        <th>🌙 Sono</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($respostas as $r): ?>
                    <tr>
                        <td class="id-cell"><?= $r['id'] ?></td>
                        <td><span class="badge <?= badgeClass($r['humor'], 'humor') ?>"><?= $r['humor'] ?></span></td>
                        <td><span class="badge <?= badgeClass($r['estresse'], 'estresse') ?>"><?= $r['estresse'] ?></span></td>
                        <td><span class="badge <?= badgeClass($r['sono'], 'sono') ?>"><?= $r['sono'] ?></span></td>
                        <td class="date-cell"><?= date('d/m/Y H:i', strtotime($r['data'])) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <span>📭</span>
            <p>Nenhuma resposta ainda.</p>
        </div>
        <?php endif; ?>

    </main>

</body>
</html>