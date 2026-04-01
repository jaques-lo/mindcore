<?php
require_once 'config/database.php';

$sql = "SELECT * FROM respostas ORDER BY data DESC";
$stmt = $pdo->query($sql);
$respostas = $stmt->fetchAll();
$total = count($respostas);

// Calcula médias
$mediaHumor = $total > 0 ? array_sum(array_column($respostas, 'humor')) / $total : 0;
$mediaEstresse = $total > 0 ? array_sum(array_column($respostas, 'estresse')) / $total : 0;
$mediaSono = $total > 0 ? array_sum(array_column($respostas, 'sono')) / $total : 0;

// Conta por nível
$humorBom = 0;
$humorMedio = 0;
$humorRuim = 0;

foreach($respostas as $r) {
    if($r['humor'] >= 7) $humorBom++;
    elseif($r['humor'] >= 4) $humorMedio++;
    else $humorRuim++;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindTest - Dashboard Admin</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <div class="container">
        <h1>MindCore - Dashboard Admin</h1>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total de Respostas</h3>
                <div class="value"><?= $total ?></div>
                <div class="label">avaliações recebidas</div>
            </div>

            <div class="stat-card">
                <h3>Média de Humor</h3>
                <div class="value"><?= round($mediaHumor, 1) ?></div>
                <div class="label">escala 0 a 10</div>
            </div>

            <div class="stat-card">
                <h3>@Média de Estresse</h3>
                <div class="value"><?= round($mediaEstresse, 1) ?></div>
                <div class="label">escala 0 a 10</div>
            </div>

            <div class="stat-card">
                <h3>Média de Sono</h3>
                <div class="value"><?= round($mediaSono, 1) ?></div>
                <div class="label">escala 0 a 10</div>
            </div>
        </div>

        <div class="chart-container">
            <div class="chart-title">Distribuição do Humor</div>
            <div class="bar-container">

                <div class="bar-item">
                    <div class="bar" style="height: <?= $total > 0 ? ($humorBom / $total * 100) : 0 ?>px;"></div>
                    <div class="bar-label">Bom</div>
                </div>

                <div class="bar-item">
                    <div class="bar medio" style="height: <?= $total > 0 ? ($humorMedio / $total * 100) : 0 ?>px;"></div>
                    <div class="bar-label">Médio</div>
                </div>

                <div class="bar-item">
                    <div class="bar ruim" style="height: <?= $total > 0 ? ($humorRuim / $total * 100) : 0 ?>px;"></div>
                    <div class="bar-label">Ruim</div>
                </div>

            </div>
        </div>

        <div class="actions">
            <button class="refresh-btn" onclick="location.reload()">Atualizar Dados</button>
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Humor</th>
                        <th>Estresse</th>
                        <th>Sono</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($respostas as $r): ?>
                <?php
                    $humorClass = $r['humor'] >= 7 ? 'bom' : ($r['humor'] >= 4 ? 'medio' : 'ruim');
                    $estresseClass = $r['estresse'] <= 3 ? 'bom' : ($r['estresse'] <= 6 ? 'medio' : 'ruim');
                    $sonoClass = $r['sono'] >= 7 ? 'bom' : ($r['sono'] >= 4 ? 'medio' : 'ruim');
                ?>

                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><span class="badge <?= $humorClass ?>"><?= $r['humor'] ?></span></td>
                    <td><span class="badge <?= $estresseClass ?>"><?= $r['estresse'] ?></span></td>
                    <td><span class="badge <?= $sonoClass ?>"><?= $r['sono'] ?></span></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($r['data'])) ?></td>
                </tr>

                <?php endforeach; ?>

                <?php if($total == 0): ?>
                <tr>
                    <td colspan="5" class="empty">Nenhuma resposta registrada</td>
                </tr>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>