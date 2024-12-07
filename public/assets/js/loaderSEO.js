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

    // Pré-carrega apenas os estilos CSS
    function preloadAssets(path) {
        const assets = {
            '/': [
                { url: '/assets/css/home.css', type: 'style' },
                { url: '/assets/css/desktop.css', type: 'style' }
            ],
            '/contato': [
                { url: '/assets/css/contact.css', type: 'style' }
            ],
            '/servicos': [
                { url: '/assets/css/services.css', type: 'style' }
            ]
        };

        const pathAssets = assets[path] || [];
        pathAssets.forEach(asset => {
            // Carrega apenas CSS
            if (asset.type === 'style') {
                const assetUrl = BASE_URL + asset.url;
                if (!loadedAssets.has(assetUrl) && 
                    !document.querySelector(`link[href="${assetUrl}"]`)) {
                    loadCSS(assetUrl);
                }
            }
        });
    }

    // Função para atualizar o conteúdo HTML
    function updateContent(html) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newContent = doc.querySelector('main'); // ou o seletor do seu container principal
        const currentContent = document.querySelector('main');
        
        if (newContent && currentContent) {
            currentContent.innerHTML = newContent.innerHTML;
        }
    }

    // Função para carregar assets específicos da página
    async function loadPageAssets(html) {
        const path = window.location.pathname;
        
        // Primeiro atualiza o conteúdo HTML
        updateContent(html);
        
        // Remove assets antigos não globais
        document.querySelectorAll('link[rel="stylesheet"]:not([data-global])').forEach(link => link.remove());
        document.querySelectorAll('script:not([data-global])').forEach(script => script.remove());

        // Carrega os novos assets específicos
        if (path === '/' || path === '/index.php') {
            await Promise.all([
                loadCSS(BASE_URL + '/assets/css/home.css'),
                loadCSS(BASE_URL + '/assets/css/desktop.css')
            ]);
            await loadScript(BASE_URL + '/assets/js/home.js');
            // Agora o elemento já existe no DOM quando a função é chamada
            if (typeof initializeTextAnimation === 'function') {
                initializeTextAnimation();
            }
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