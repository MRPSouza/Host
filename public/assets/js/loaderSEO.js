document.addEventListener('DOMContentLoaded', function() {
    // Obtém o BASE_URL do meta tag ou define um padrão
    const BASE_URL = document.querySelector('meta[name="base-url"]')?.content || '';

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

    // Função para carregar CSS
    function loadCSS(url) {
        return new Promise((resolve, reject) => {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = url;
            link.onload = resolve;
            link.onerror = reject;
            document.head.appendChild(link);
        });
    }

    // Função para carregar assets específicos da página
    async function loadPageAssets(html) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const path = window.location.pathname;

        // Remove CSS e scripts antigos específicos da página
        document.querySelectorAll('link[rel="stylesheet"]:not([data-global])').forEach(link => link.remove());
        document.querySelectorAll('script:not([data-global])').forEach(script => script.remove());

        // Carrega os novos assets específicos
        if (path === '/' || path === '/index.php') {
            // Assets da página inicial
            await Promise.all([
                loadCSS(BASE_URL + '/assets/css/home.css'),
                loadCSS(BASE_URL + '/assets/css/desktop.css'),
                loadScript(BASE_URL + '/assets/js/home.js')
            ]).then(() => {
                if (typeof initializeTextAnimation === 'function') {
                    initializeTextAnimation();
                }
            });
        } else if (path.includes('/contato')) {
            // Assets da página de contato
            await Promise.all([
                loadCSS(BASE_URL + '/assets/css/contact.css'),
                loadScript(BASE_URL + '/assets/js/contact.js')
            ]);
        } else if (path.includes('/servicos')) {
            // Assets da página de serviços
            await Promise.all([
                loadCSS(BASE_URL + '/assets/css/services.css'),
                loadScript(BASE_URL + '/assets/js/services.js')
            ]);
        }
    }

    // Função para carregar script
    function loadScript(url) {
        return new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = url;
            script.onload = resolve;
            script.onerror = reject;
            document.body.appendChild(script);
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
                updateSEO(html);
                loadPageAssets(html);
                history.pushState({}, '', link.href);
            });
        }
    });

    // Atualiza ao usar o botão voltar do navegador
    window.addEventListener('popstate', function() {
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            updateSEO(html);
            loadPageAssets(html);
        });
    });
});