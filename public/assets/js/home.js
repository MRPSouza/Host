console.log('home.js carregado');

// Variável global para controlar os timeouts
window.textAnimationTimeouts = window.textAnimationTimeouts || [];

function initializeTextAnimation() {
    console.log('Inicializando animação de texto');
    
    // Limpa todas as animações anteriores
    window.textAnimationTimeouts.forEach(timeout => clearTimeout(timeout));
    window.textAnimationTimeouts = [];
    
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
    let esperaAntesDeApagar = 4000;
    let esperaAntesDeEscrever = 200;
    const velocidadeDigitacao = 50;
    const velocidadeApagar = 25;

    const elementoTexto = document.getElementById('texto-animado');
    console.log('Elemento texto encontrado:', !!elementoTexto);
    
    if (elementoTexto) {
        console.log('Iniciando animação');

        // Função para adicionar timeout à lista de controle
        function addTimeout(callback, delay) {
            const timeout = setTimeout(callback, delay);
            window.textAnimationTimeouts.push(timeout);
            return timeout;
        }

        // Primeiro apaga o texto default
        function apagarTextoInicial() {
            if (!elementoTexto) return;
            
            const textoAtual = elementoTexto.textContent;
            if (textoAtual.length > 0) {
                elementoTexto.textContent = textoAtual.slice(0, -1);
                requestAnimationFrame(() => {
                    addTimeout(apagarTextoInicial, velocidadeApagar);
                });
            } else {
                addTimeout(escrever, esperaAntesDeEscrever);
            }
        }

        function escrever() {
            if (!elementoTexto) return;
            
            if (letraAtual < textos[textoAtual].length) {
                elementoTexto.textContent += textos[textoAtual].charAt(letraAtual);
                letraAtual++;
                requestAnimationFrame(() => {
                    addTimeout(escrever, velocidadeDigitacao);
                });
            } else {
                addTimeout(apagar, esperaAntesDeApagar);
            }
        }

        function apagar() {
            if (!elementoTexto) return;
            
            if (letraAtual > 0) {
                elementoTexto.textContent = textos[textoAtual].substring(0, letraAtual - 1) || "\u00A0";
                letraAtual--;
                requestAnimationFrame(() => {
                    addTimeout(apagar, velocidadeApagar);
                });
            } else {
                textoAtual = (textoAtual + 1) % textos.length;
                addTimeout(escrever, esperaAntesDeEscrever);
            }
        }

        // Inicia a animação
        addTimeout(apagarTextoInicial, esperaAntesDeApagar);
    }
}

// Inicializa na carga inicial
document.addEventListener('DOMContentLoaded', initializeTextAnimation);

// Reinicializa após cada navegação
document.addEventListener('navigationComplete', function(e) {
    console.log('Evento navigationComplete recebido');
    if (e.detail.path === '/' || e.detail.path === '/index.php') {
        console.log('Reinicializando animação de texto');
        setTimeout(initializeTextAnimation, 100);
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