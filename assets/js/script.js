// ── Atualiza valores dos sliders em tempo real ──
document.querySelectorAll('input[type="range"]').forEach(input => {
    const badge = document.getElementById(input.id + 'Value');
    if (!badge) return;

    input.addEventListener('input', function () {
        badge.textContent = this.value;

        // Cor dinâmica no badge de acordo com o slider
        const val = parseInt(this.value);
        const id  = this.id;
        let color = '#00e5ff'; // padrão ciano

        if (id === 'estresse') {
            if (val <= 3)      color = '#22c55e';
            else if (val <= 6) color = '#f59e0b';
            else               color = '#ef4444';
        } else {
            if (val >= 7)      color = '#22c55e';
            else if (val >= 4) color = '#f59e0b';
            else               color = '#ef4444';
        }

        badge.style.borderColor = color;
        badge.style.color       = color;
    });
});

// ── Função de envio ──
async function enviar() {
    const btn = document.querySelector('.btn-send');
    const div = document.getElementById('resultado');

    const dados = {
        humor:    parseInt(document.getElementById('humor').value),
        estresse: parseInt(document.getElementById('estresse').value),
        sono:     parseInt(document.getElementById('sono').value)
    };

    // Estado de loading
    btn.disabled = true;
    btn.querySelector('.btn-text').textContent = 'Enviando...';
    div.textContent = '';

    try {
        const res = await fetch('api/salvar.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dados)
        });

        const json = await res.json();

        if (json.status === 'sucesso') {
            div.style.color = '#22c55e';
            div.textContent = '✓ Resposta enviada com sucesso!';
            // Reset sliders
            setTimeout(() => {
                document.querySelectorAll('input[type="range"]').forEach(i => {
                    i.value = 5;
                    i.dispatchEvent(new Event('input'));
                });
                div.textContent = '';
            }, 3000);
        } else {
            div.style.color = '#ef4444';
            div.textContent = '✗ ' + (json.mensagem || 'Erro ao salvar.');
        }

    } catch (e) {
        div.style.color = '#ef4444';
        div.textContent = '✗ Erro de conexão com o servidor.';
    } finally {
        btn.disabled = false;
        btn.querySelector('.btn-text').textContent = 'Enviar resposta';
    }
}