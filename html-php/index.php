<!DOCTYPE html>
<!-- Define que o documento está em HTML5 (modo padrão de renderização) -->

<html lang="pt-BR">
<!-- Elemento raiz do documento. lang="pt-BR" define o idioma como português do Brasil (útil para acessibilidade e SEO) -->

<head>
    <!-- Cabeçalho do documento - contém metadados, não é visível na página -->
    
    <meta charset="UTF-8">
    <!-- Define a codificação de caracteres como UTF-8 (permite acentos, emojis, caracteres especiais) -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Controla o viewport em dispositivos móveis: 
         - width=device-width: largura igual à tela do dispositivo
         - initial-scale=1.0: zoom inicial padrão -->
    
    <title>MindCore - Bem-Estar</title>
    <!-- Define o título que aparece na aba do navegador -->
    
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Link para o arquivo CSS externo (estilização da página) 
         ../ significa "sobe um nível na pasta" -->
    
    <link rel="icon" type="image/png" href="../assets/imagens/mindcore-logo.png">
    <!-- Define o ícone que aparece na aba do navegador (favicon) -->
</head>




<body>
    <!-- Corpo do documento - todo conteúdo visível da página fica aqui -->

    <img src="assets/imagens/mindcore-logo.png" class="logo">
<!-- Exibe a imagem do logo. src aponta para o arquivo, class aplica estilo CSS -->
    
    <script src="../assets/js/script.js"></script>
    <!-- Carrega um arquivo JavaScript externo (se existir) 
         ATENÇÃO: carregado antes do conteúdo HTML, pode causar atraso na renderização -->
    
    <div class="card">
        <!-- Div container com classe "card" (provavelmente estilizada como cartão/flutuante) -->
        
        <h1>MindCore</h1>
        <!-- Título principal nível 1 (mais importante) -->
        
        <h2>Como você está se sentindo hoje?</h2>
        <!-- Subtítulo nível 2 -->
        
        <div class="slider-group">
            <!-- Agrupa um slider com seu label e valor -->
            
            <label for="humor">Humor <span>(0 = péssimo, 10 = excelente)</span></label>
            <!-- Rótulo do campo. for="humor" associa ao input com id="humor"
                 <span> é um texto dentro do label com explicação adicional -->
            
            <input type="range" id="humor" min="0" max="10" value="5" oninput="updateValue('humor')">
            <!-- Input tipo slider (controle deslizante):
                 - type="range": cria um controle deslizante
                 - id="humor": identificador único
                 - min="0": valor mínimo
                 - max="10": valor máximo
                 - value="5": valor inicial
                 - oninput="updateValue('humor')": executa função JavaScript quando o valor muda -->
            
            <span class="value" id="humorValue">5</span>
            <!-- Span que exibe o valor atual do slider. id="humorValue" para ser atualizado via JS -->
        </div>
        
        <div class="slider-group">
            <!-- Grupo do slider de estresse (mesma estrutura, mas mede nível de estresse) -->
            <label for="estresse">Estresse <span>(0 = nenhum, 10 = extremo)</span></label>
            <input type="range" id="estresse" min="0" max="10" value="5" oninput="updateValue('estresse')">
            <span class="value" id="estresseValue">5</span>
        </div>
        
        <div class="slider-group">
            <!-- Grupo do slider de sono (mede qualidade do sono) -->
            <label for="sono">Sono <span>(0 = péssimo, 10 = excelente)</span></label>
            <input type="range" id="sono" min="0" max="10" value="5" oninput="updateValue('sono')">
            <span class="value" id="sonoValue">5</span>
        </div>
        
        <button onclick="enviar()">
            <!-- Botão que dispara a função enviar() quando clicado -->
            📤 Enviar Resposta
            <!-- Emoji de envelope + texto -->
        </button>
        
        <div id="resultado"></div>
        <!-- Div vazia que receberá o resultado/feedback após o envio (via JavaScript) -->
        
        <div class="footer">
            <!-- Rodapé da página -->
            Seus dados são anônimos e confidenciais<br>
            <!-- <br> quebra de linha -->
            <small>Juntos cuidamos da saúde mental no trabalho</small>
            <!-- <small> deixa o texto menor (menos importante visualmente) -->
        </div>
    </div>
    
    <script>
        // Bloco de JavaScript embutido no HTML
        
        function updateValue(id) {
            // Função que atualiza o valor exibido ao lado do slider
            // Parâmetro id: identifica qual slider foi movido ('humor', 'estresse' ou 'sono')
            
            const val = document.getElementById(id).value;
            // Pega o elemento input pelo id e obtém seu valor atual
            
            document.getElementById(id + 'Value').innerText = val;
            // Encontra o span correspondente (ex: 'humorValue') e atualiza o texto com o valor
        }
    </script>
    
    <script src="assets/js/script.js"></script>
    <!-- Carrega outro arquivo JavaScript (possivelmente contém a função enviar())
         ATENÇÃO: carregado duas vezes (já tem um no início do body) -->
</body>
</html>
<!-- Fim do documento HTML -->