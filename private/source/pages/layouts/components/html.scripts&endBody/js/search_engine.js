let destacado = false;

document.addEventListener("DOMContentLoaded", function() {
    destacarPosicaoSeNecessario();
});

function destacarPosicaoSeNecessario() {
    if (destacado) return;

    var urlParams = new URLSearchParams(window.location.search);
    var posicao = urlParams.get('posicao');
    var termo = urlParams.get('q');
    var frase = urlParams.get('frase');

    if (termo && frase) {
        localizarEDestacarFrase(termo, frase);
    } else if (termo) {
        localizarEDestacarTermo(termo);
    }
}

function localizarEDestacarTermo(termo) {
    var regex = new RegExp(termo, 'gi');
    var textos = document.evaluate(
        "//text()[contains(translate(., 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), '" + termo.toLowerCase() + "')]",
        document,
        null,
        XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,
        null
    );

    for (var i = 0; i < textos.snapshotLength; i++) {
        var nodo = textos.snapshotItem(i);
        var novoConteudo = nodo.textContent.replace(regex, function(match) {
            return '<mark style="background-color: yellow; padding: 2px;">' + match + '</mark>';
        });

        var span = document.createElement('span');
        span.innerHTML = novoConteudo;
        nodo.parentNode.replaceChild(span, nodo);

        if (i === 0) {
            span.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    destacado = true;
}

function localizarEDestacarFrase(termo, frase) {
    var regex = new RegExp(escapeRegExp(frase), 'gi');
    var textos = document.evaluate(
        "//text()[contains(translate(., 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz'), '" + frase.toLowerCase() + "')]",
        document,
        null,
        XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,
        null
    );

    for (var i = 0; i < textos.snapshotLength; i++) {
        var nodo = textos.snapshotItem(i);
        var novoConteudo = nodo.textContent.replace(regex, function(match) {
            return '<mark style="background-color: yellow; padding: 2px;">' + match + '</mark>';
        });

        var span = document.createElement('span');
        span.innerHTML = novoConteudo;
        nodo.parentNode.replaceChild(span, nodo);

        if (i === 0) {
            span.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    destacado = true;
}

function escapeRegExp(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

function destacarPosicao(index) {
    if (!isNaN(index) && index >= 0) {
        var walker = document.createTreeWalker(
            document.body,
            NodeFilter.SHOW_TEXT,
            null,
            false
        );
        var currentIndex = 0;
        var targetNode, targetOffset;

        while (walker.nextNode()) {
            var textNode = walker.currentNode;
            if (currentIndex + textNode.length > index) {
                targetNode = textNode;
                targetOffset = index - currentIndex;
                break;
            }
            currentIndex += textNode.length;
        }

        if (targetNode) {
            var range = document.createRange();
            var selection = window.getSelection();
            range.setStart(targetNode, targetOffset);
            range.setEnd(targetNode, targetOffset + 1);
            selection.removeAllRanges();
            selection.addRange(range);

            targetNode.parentElement.scrollIntoView({behavior: "smooth", block: "center"});
            
            var span = document.createElement('span');
            span.style.backgroundColor = 'yellow';
            range.surroundContents(span);
            destacado = true;
        }
    }
}

// Adicione um evento para lidar com mudanças na história do navegador
window.addEventListener('popstate', function(event) {
    destacado = false;
    destacarPosicaoSeNecessario();
});

// Adicione este evento para garantir que o destaque seja feito após o carregamento dinâmico do conteúdo
document.addEventListener('DOMContentLoaded', function() {
    destacarPosicaoSeNecessario();
});

// Modifique o observer para usar a nova função
let observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        if (mutation.type === 'childList') {
            destacarPosicaoSeNecessario();
        }
    });
});

observer.observe(document.body, { childList: true, subtree: true });
/**
 * Objetivo: Implementar uma funcionalidade de pesquisa e destaque similar ao Ctrl+F
 * 
 * Estamos tentando criar um sistema que:
 * 1. Capture o termo de pesquisa e a frase exata clicada nos resultados da pesquisa
 * 2. Navegue para a página correta com esses parâmetros na URL
 * 3. Localize a frase exata na página de destino
 * 4. Destaque a frase encontrada e role a página até ela
 * 5. Funcione com carregamento dinâmico de conteúdo
 * 
 * Dependências importantes:
 * - Input de pesquisa: Este script depende de um campo de input para a pesquisa.
 *   Geralmente, este input tem um id como 'search-input' ou uma classe como 'search-field'.
 * - Botão de submit: Um botão ou input do tipo submit para iniciar a pesquisa.
 *   Normalmente, este elemento tem um id como 'search-submit' ou uma classe como 'search-button'.
 * 
 * Certifique-se de que estes elementos estejam presentes no HTML e que seus seletores
 * estejam corretamente referenciados neste script.
 * 
 * Estrutura de pastas relevante:
 * - Programador/
 *   |- public/
 *   |  |- search_engine.php (arquivo que gera os resultados da pesquisa)
 *   |- source/
 *      |- assets/
 *         |- js/
 *            |- search_engine.js (este arquivo)
 *            |- content-dynamic.js (lida com o carregamento dinâmico de conteúdo)
 * 
 * Lembrete: Para acessar e modificar estes arquivos, use o caminho completo a partir da raiz do projeto.
 * Por exemplo, para este arquivo: Programador/source/assets/js/search_engine.js
 * 
 * Próximos passos:
 * 1. Verificar se os parâmetros 'q' e 'frase' estão sendo passados corretamente na URL
 * 2. Melhorar a função de localização e destaque para usar a frase exata
 * 3. Testar o funcionamento com conteúdo carregado dinamicamente
 * 4. Adicionar logs detalhados para facilitar a depuração
 * 5. Garantir que os event listeners para o input de pesquisa e o botão de submit estejam funcionando corretamente
 */

// Código existente começa aqui...