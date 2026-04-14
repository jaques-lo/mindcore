// Atualiza os valores na tela ao arrastar os sliders
document.querySelectorAll('input[type="range"]').forEach(input => {
    input.oninput = function() {
        document.getElementById(this.id + 'Value').innerHTML = this.value;
    };
});

async function enviar() {
    const dados = {
        humor: parseInt(document.getElementById('humor').value),
        estresse: parseInt(document.getElementById('estresse').value),
        sono: parseInt(document.getElementById('sono').value)
    };
    
    const div = document.getElementById('resultado');
    
    try {
        // Envia para a pasta api/
        const res = await fetch('../api/salvar.php',  {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dados)
        });
        
        const texto = await res.json();
        
        if (texto.status === 'sucesso') {
            div.style.color = "#22c55e";
            div.innerHTML = '✓ ' + texto.mensagem;
        } else {
            div.style.color = "#ef4444";
            div.innerHTML = '✗ ' + texto.mensagem;
        }
    } catch(e) {
        div.style.color = "#ef4444";
        div.innerHTML = '✗ Erro de conexão (404 ou servidor offline)';
    }
}