/**
 * ATUALIZAÇÃO EM TEMPO REAL (UI)
 * Estes blocos monitoram os controles deslizantes (inputs do tipo range).
 * Sempre que o usuário arrasta a barrinha (oninput), o número ao lado é atualizado.
 */

// Monitora o slider de Humor
document.getElementById('humor').oninput = function() {
    // 'this.value' pega o número atual da barra (0-10) e coloca no elemento de texto
    document.getElementById('humorValue').innerHTML = this.value;
};

// Monitora o slider de Estresse
document.getElementById('estresse').oninput = function() {
    document.getElementById('estresseValue').innerHTML = this.value;
};

// Monitora o slider de Sono
document.getElementById('sono').oninput = function() {
    document.getElementById('sonoValue').innerHTML = this.value;
};

/**
 * ENVIO DOS DADOS (API)
 * Função assíncrona que coleta os dados e envia para o PHP via AJAX (Fetch API).
 */
async function enviar() {
    // 1. Coleta os valores atuais dos inputs e garante que sejam números inteiros (parseInt)
    const dados = {
        humor: parseInt(document.getElementById('humor').value),
        estresse: parseInt(document.getElementById('estresse').value),
        sono: parseInt(document.getElementById('sono').value)
    };
    
    // Referência da DIV onde aparecerá a mensagem de "Sucesso" ou "Erro"
    const div = document.getElementById('resultado');
    
    try {
        // 2. Faz a requisição para o arquivo PHP
        const res = await fetch('api/salvar.php', {
            method: 'POST', // Método de envio
            headers: { 'Content-Type': 'application/json' }, // Avisa ao PHP que estamos enviando um JSON
            body: JSON.stringify(dados) // Transforma o objeto JS em uma string de texto JSON
        });

        // 3. Espera a resposta do PHP e converte de volta para objeto JS
        const texto = await res.json();
        
        // 4. Verifica o status retornado pela nossa API (salvar.php)
        if (texto.status === 'sucesso') {
            div.className = 'sucesso'; // Aplica estilo CSS de sucesso (ex: verde)
            div.innerHTML = '✓ ' + texto.mensagem;
        } else {
            div.className = 'erro';    // Aplica estilo CSS de erro (ex: vermelho)
            div.innerHTML = '✗ ' + texto.mensagem;
        }

    } catch(e) {
        // Caso ocorra um erro de rede ou o servidor esteja fora do ar
        div.className = 'erro';
        div.innerHTML = '✗ Erro de conexão';
    }
}