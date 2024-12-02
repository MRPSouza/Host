(function() {
    if (!window.performance || !window.performance.getEntriesByType || 
        window.performance.getEntriesByType('navigation')[0].type === 'reload' ||
        window.performance.getEntriesByType('navigation')[0].type === 'navigate') {
        
        setTimeout(function() {
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
            let animacaoEmAndamento = false;

            const elementoTexto = document.getElementById('texto-animado');
            
            if (elementoTexto && !animacaoEmAndamento) {
                animacaoEmAndamento = true;

                // Primeiro apaga o texto default
                function apagarTextoInicial() {
                    if (!elementoTexto) return;
                    
                    const textoAtual = elementoTexto.textContent;
                    if (textoAtual.length > 0) {
                        elementoTexto.textContent = textoAtual.slice(0, -1);
                        requestAnimationFrame(() => setTimeout(apagarTextoInicial, velocidadeApagar));
                    } else {
                        // Depois de apagar, começa a animação normal
                        setTimeout(escrever, esperaAntesDeEscrever);
                    }
                }

                function escrever() {
                    if (!elementoTexto) return;
                    
                    if (letraAtual < textos[textoAtual].length) {
                        elementoTexto.textContent += textos[textoAtual].charAt(letraAtual);
                        letraAtual++;
                        requestAnimationFrame(() => setTimeout(escrever, velocidadeDigitacao));
                    } else {
                        setTimeout(apagar, esperaAntesDeApagar);
                    }
                }

                function apagar() {
                    if (!elementoTexto) return;
                    
                    if (letraAtual > 0) {
                        elementoTexto.textContent = textos[textoAtual].substring(0, letraAtual - 1) || "\u00A0";
                        letraAtual--;
                        requestAnimationFrame(() => setTimeout(apagar, velocidadeApagar));
                    } else {
                        textoAtual = (textoAtual + 1) % textos.length;
                        setTimeout(escrever, esperaAntesDeEscrever);
                    }
                }

                // Aumenta o tempo de espera antes de começar a apagar
                setTimeout(apagarTextoInicial, esperaAntesDeApagar);
            }
        }, 500);
    }
})();