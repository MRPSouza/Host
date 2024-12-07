document.addEventListener('DOMContentLoaded', function() {
    const BASE_URL = document.querySelector('meta[name="base-url"]')?.content || '';
    
    // Cache para assets já carregados
    const loadedAssets = new Set();

    // Função para carregar CSS com cache
    function loadCSS(url) {
        if (loadedAssets.has(url)) {
            return Promise.resolve();
        }

        return new Promise((resolve, reject) => {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = url;
            link.fetchPriority = 'high';
            
            link.onload = () => {
                loadedAssets.add(url);
                resolve();
            };
            link.onerror = reject;
            requestAnimationFrame(() => {
                document.head.appendChild(link);
            });
        });
    }

    // Função para carregar script com cache
    function loadScript(url) {
        if (loadedAssets.has(url)) {
            return Promise.resolve();
        }

        return new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = url;
            script.async = true;
            script.fetchPriority = 'high';
            
            script.onload = () => {
                loadedAssets.add(url);
                resolve();
            };
            script.onerror = reject;
            requestAnimationFrame(() => {
                document.body.appendChild(script);
            });
        });
    }

    // Pré-carrega os assets da próxima página
    function preloadAssets(path) {
        const assets = {
            '/': [
                '/assets/css/home.css',
                '/assets/css/desktop.css',
                '/assets/js/home.js'
            ],
            '/contato': [
                '/assets/css/contact.css',
                '/assets/js/contact.js'
            ],
            '/servicos': [
                '/assets/css/services.css',
                '/assets/js/services.js'
            ]
        };

        const pathAssets = assets[path] || [];
        pathAssets.forEach(asset => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = asset.endsWith('.css') ? 'style' : 'script';
            link.href = BASE_URL + asset;
            document.head.appendChild(link);
        });
    }

    // Função para carregar assets específicos da página
    async function loadPageAssets(html) {
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
            await loadCSS(BASE_URL + '/assets/css/contact.css');
            await loadScript(BASE_URL + '/assets/js/contact.js');
        } else if (path.includes('/servicos')) {
            await loadCSS(BASE_URL + '/assets/css/services.css');
            await loadScript(BASE_URL + '/assets/js/services.js');
        }
    }

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
            const url = new URL(link.href);
            
            // Pré-carrega os assets da página de destino
            preloadAssets(url.pathname);
            
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