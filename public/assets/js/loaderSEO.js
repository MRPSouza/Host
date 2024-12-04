document.addEventListener('DOMContentLoaded', function() {
    // Função para atualizar as meta tags de SEO
    function updateSEO(html) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const seoData = doc.querySelector('seo-data');
        if (seoData) {
            const head = document.querySelector('head');
            // Remove as meta tags antigas de SEO
            head.querySelectorAll('meta[name="description"], meta[name="keywords"], title, meta[property^="og:"]').forEach(el => el.remove());
            
            // Adiciona apenas as novas meta tags de SEO
            const seoContent = seoData.innerHTML;
            head.insertAdjacentHTML('afterbegin', seoContent);
        }
    }

    // Função para atualizar CSS e JS
    function updateAssets(html) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newLinks = doc.querySelectorAll('link[rel="stylesheet"]');
        const newScripts = doc.querySelectorAll('script[src]');

        const head = document.querySelector('head');

        // Remove CSS e JS antigos que não são globais
        head.querySelectorAll('link[rel="stylesheet"]:not([data-global]), script[src]:not([data-global])').forEach(el => el.remove());

        // Adiciona novos CSS
        newLinks.forEach(link => {
            if (!link.hasAttribute('data-global')) {
                head.appendChild(link.cloneNode(true));
            }
        });

        // Adiciona novos JS
        newScripts.forEach(script => {
            if (!script.hasAttribute('data-global')) {
                const newScript = document.createElement('script');
                newScript.src = script.src;
                head.appendChild(newScript);
            }
        });
    }

    // Intercepta cliques em links para navegação AJAX
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && 
            !link.target && 
            !e.ctrlKey && 
            !e.shiftKey && 
            !link.hasAttribute('download') && 
            link.href.indexOf('tel:') !== 0 && 
            link.href.indexOf('mailto:') !== 0) {
            
            e.preventDefault();
            
            fetch(link.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // Atualiza as meta tags de SEO
                updateSEO(html);
                // Atualiza CSS e JS
                updateAssets(html);
            });
        }
    });

    // Atualiza SEO, CSS e JS ao usar o botão voltar do navegador
    window.addEventListener('popstate', function() {
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            updateSEO(html);
            updateAssets(html);
        });
    });
});