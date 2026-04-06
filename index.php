<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCore - Bem-Estar no Trabalho</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/png" href="assets/imagens/mindcore-icon.ico>
</head>
<body>
    <div class="card">
        <h1>
            <span class="emoji"></span> MindCore
        </h1>
        <h2>Como você está se sentindo hoje?</h2>
        
        <div class="slider-group">
            <label>Humor <span>(0 = péssimo, 10 = excelente)</span></label>
            <input type="range" id="humor" min="0" max="10" value="5">
            <span class="value" id="humorValue">5</span>
        </div>
        
        <div class="slider-group">
            <label>Estresse <span>(0 = nenhum, 10 = extremo)</span></label>
            <input type="range" id="estresse" min="0" max="10" value="5">
            <span class="value" id="estresseValue">5</span>
        </div>
        
        <div class="slider-group">
            <label>Sono <span>(0 = péssimo, 10 = excelente)</span></label>
            <input type="range" id="sono" min="0" max="10" value="5">
            <span class="value" id="sonoValue">5</span>
        </div>
        
        <button onclick="enviar()">
            📤 Enviar Resposta
        </button>
        
        <div id="resultado"></div>
        
        <div class="footer">
            Seus dados são anônimos e confidenciais<br>
            <small>Juntos cuidamos da saúde mental no trabalho</small>
        </div>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>
