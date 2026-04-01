document.getElementById('humor').oninput = function() {
    document.getElementById('humorValue').innerHTML = this.value;
};
document.getElementById('estresse').oninput = function() {
    document.getElementById('estresseValue').innerHTML = this.value;
};
document.getElementById('sono').oninput = function() {
    document.getElementById('sonoValue').innerHTML = this.value;
};

async function enviar() {
    const dados = {
        humor: parseInt(document.getElementById('humor').value),
        estresse: parseInt(document.getElementById('estresse').value),
        sono: parseInt(document.getElementById('sono').value)
    };
    
    const div = document.getElementById('resultado');
    
    try {
        const res = await fetch('api/salvar.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dados)
        });
        const texto = await res.json();
        
        if (texto.status === 'sucesso') {
            div.className = 'sucesso';
            div.innerHTML = '✓ ' + texto.mensagem;
        } else {
            div.className = 'erro';
            div.innerHTML = '✗ ' + texto.mensagem;
        }
    } catch(e) {
        div.className = 'erro';
        div.innerHTML = '✗ Erro de conexão';
    }
}
