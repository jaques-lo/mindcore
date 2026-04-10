<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCore - Bem-Estar</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" type="image/png" href="../assets/imagens/mindcore-logo.png">
</head>

     <img src="assets/imagens/mindcore-logo.png" class="logo">

<body>
    <script src="../assets/js/script.js"></script>
    <div class="card">
        <h1>
            MindCore
        </h1>
        <h2>Como você está se sentindo hoje?</h2>
        
        <div class="slider-group">
            <label for="humor">Humor <span>(0 = péssimo, 10 = excelente)</span></label>
            <input type="range" id="humor" min="0" max="10" value="5" oninput="updateValue('humor')">
            <span class="value" id="humorValue">5</span>
        </div>
        
        <div class="slider-group">
            <label for="estresse">Estresse <span>(0 = nenhum, 10 = extremo)</span></label>
            <input type="range" id="estresse" min="0" max="10" value="5" oninput="updateValue('estresse')">
            <span class="value" id="estresseValue">5</span>
        </div>
        
        <div class="slider-group">
            <label for="sono">Sono <span>(0 = péssimo, 10 = excelente)</span></label>
            <input type="range" id="sono" min="0" max="10" value="5" oninput="updateValue('sono')">
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
    
    <script>
        function updateValue(id) {
            const val = document.getElementById(id).value;
            document.getElementById(id + 'Value').innerText = val;
        }
    </script>
    <script src="assets/js/script.js"></script>
</body>
</html>