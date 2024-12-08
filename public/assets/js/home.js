(function() {
    setTimeout(function() {
        const textos = [
            "Bem-vindo à MisterCel!",
            "Aqui seu celular tem solução.",
            "Consertos rápidos e de qualidade.",
            "Reparamos smartphones e tablets.",
            "Peças originais ou paralelas com garantia.",
            "Técnicos experientes e certificados.",
            "Orçamento grátis e sem compromisso.",
            "Consertamos todas as marcas.",
            "Experiência e confiança.",
            "Reparos rápidos e eficazes.",
            "Garantia em todos os serviços.",
            "Seu celular pronto rapidamente.",
            "Faça um orçamento com a MisterCel!"
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

            setTimeout(escrever, 100);
        }
    }, 500);
})();