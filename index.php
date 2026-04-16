<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindCore - Bem-Estar</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/imagens/mindcore-icon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>

    <div class="bg-grid"></div>
    <div class="bg-glow"></div>

    <header class="site-header">
        <div class="logo-mark">M</div>
        <span class="logo-text">MindCore</span>
    </header>


    <main class="main-wrap">
        <div class="card">

            <div class="card-header">
                <h1>Como você está<br><em>hoje?</em></h1>
                <p class="subtitle">Resposta anônima · menos de 1 minuto</p>
            </div>

            <div class="sliders-wrap">

                <div class="slider-group" data-label="humor">
                    <div class="slider-top">
                        <label for="humor">
                            Humor
                        </label>
                        <span class="value-badge" id="humorValue">5</span>
                    </div>
                    <div class="slider-track-wrap">
                        <input type="range" id="humor" min="0" max="10" value="5">
                    </div>
                    <div class="slider-hints"><span>Péssimo</span><span>Excelente</span></div>
                </div>

                <div class="slider-group" data-label="estresse">
                    <div class="slider-top">
                        <label for="estresse">
                            Estresse
                        </label>
                        <span class="value-badge" id="estresseValue">5</span>
                    </div>
                    <div class="slider-track-wrap">
                        <input type="range" id="estresse" min="0" max="10" value="5">
                    </div>
                    <div class="slider-hints"><span>Nenhum</span><span>Extremo</span></div>
                </div>

                <div class="slider-group" data-label="sono">
                    <div class="slider-top">
                        <label for="sono">
                            Sono
                        </label>
                        <span class="value-badge" id="sonoValue">5</span>
                    </div>
                    <div class="slider-track-wrap">
                        <input type="range" id="sono" min="0" max="10" value="5">
                    </div>
                    <div class="slider-hints"><span>Péssimo</span><span>Excelente</span></div>
                </div>

            </div>

            <button class="btn-send" onclick="enviar()">
                <span class="btn-text">Enviar resposta</span>
                <span class="btn-icon">→</span>
            </button>

            <div id="resultado" class="resultado"></div>

            <footer class="card-footer">
                Seus dados são anônimos e confidenciais.<br>
                <small>Juntos cuidamos da saúde mental no trabalho.</small>
            </footer>

        </div>
    </main>

    <script src="assets/js/script.js"></script>
</body>
</html>