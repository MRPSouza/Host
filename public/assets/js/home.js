console.log('home.js carregado');

function initializeTextAnimation() {
    console.log('Inicializando animação de texto');
    
    const textos = [
        "Seu celular tem conserto",
        "Reparo rápido e garantido",
        "Atendemos todas as marcas",
        "Técnicos certificados",
        "Orçamento sem compromisso",
        "Fale com a MisterCel!"
    ];

    let textoAtual = 0;
    let letraAtual = 0;
    const esperaAntesDeApagar = 4000;
    const esperaAntesDeEscrever = 200;
    const velocidadeDigitacao = 50;
    const velocidadeApagar = 25;

    const elementoTexto = document.getElementById('texto-animado');
    console.log('Elemento texto encontrado:', !!elementoTexto);
    
    if (elementoTexto) {
        console.log('Iniciando animação');
        
        // Cancela animação anterior se existir
        if (window.animationFrame) {
            cancelAnimationFrame(window.animationFrame);
        }

        let ultimoTimestamp = 0;
        let esperando = 0;
        let modo = 'apagar-inicial';

        function animate(timestamp) {
            if (!elementoTexto) return;

            const delta = timestamp - ultimoTimestamp;

            if (esperando > 0) {
                esperando -= delta;
                ultimoTimestamp = timestamp;
                window.animationFrame = requestAnimationFrame(animate);
                return;
            }

            switch (modo) {
                case 'apagar-inicial':
                    const textoInicial = elementoTexto.textContent;
                    if (textoInicial.length > 0) {
                        elementoTexto.textContent = textoInicial.slice(0, -1);
                        esperando = velocidadeApagar;
                    } else {
                        modo = 'escrever';
                        esperando = esperaAntesDeEscrever;
                    }
                    break;

                case 'escrever':
                    if (letraAtual < textos[textoAtual].length) {
                        elementoTexto.textContent += textos[textoAtual].charAt(letraAtual);
                        letraAtual++;
                        esperando = velocidadeDigitacao;
                    } else {
                        modo = 'esperar';
                        esperando = esperaAntesDeApagar;
                    }
                    break;

                case 'esperar':
                    modo = 'apagar';
                    break;

                case 'apagar':
                    if (letraAtual > 0) {
                        elementoTexto.textContent = textos[textoAtual].substring(0, letraAtual - 1) || "\u00A0";
                        letraAtual--;
                        esperando = velocidadeApagar;
                    } else {
                        textoAtual = (textoAtual + 1) % textos.length;
                        modo = 'escrever';
                        esperando = esperaAntesDeEscrever;
                    }
                    break;
            }

            ultimoTimestamp = timestamp;
            window.animationFrame = requestAnimationFrame(animate);
        }

        window.animationFrame = requestAnimationFrame(animate);
    }
}

// Inicializa na carga inicial
document.addEventListener('DOMContentLoaded', initializeTextAnimation);

// Reinicializa após cada navegação
document.addEventListener('navigationComplete', function(e) {
    console.log('Evento navigationComplete recebido');
    if (e.detail.path === '/' || e.detail.path === '/index.php') {
        console.log('Reinicializando animação de texto');
        initializeTextAnimation();
    }
});

function initializeHome() {
    const taskbarTime = document.getElementById('taskbar-time');
    
    // Limpa intervalos anteriores se existirem
    if (window.clockInterval) {
        clearInterval(window.clockInterval);
    }
    
    // Atualiza o relógio
    function updateClock() {
        if (taskbarTime) {
            const now = new Date();
            taskbarTime.textContent = now.toLocaleTimeString();
        }
    }

    // Inicializa o relógio
    if (taskbarTime) {
        updateClock();
        window.clockInterval = setInterval(updateClock, 1000);
    }
}

// Inicializa na carga inicial
document.addEventListener('DOMContentLoaded', initializeHome);

// Reinicializa após cada navegação
document.addEventListener('navigationComplete', function(e) {
    if (e.detail.path === '/' || e.detail.path === '/index.php') {
        initializeHome();
    }
});