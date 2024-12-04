// Executa antes do DOMContentLoaded
(function() {
    // 1. Definição das funções principais
    const cleanExistingLoaders = () => {
        const existingLoaders = document.querySelectorAll('#preloader');
        existingLoaders.forEach(loader => loader.remove());
    };

    const createLoader = () => {
        cleanExistingLoaders();
        const loader = document.createElement('div');
        loader.id = 'preloader';
        loader.innerHTML = '<div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div>';
        document.body.appendChild(loader);
        return loader;
    };

    const hideLoader = () => {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.classList.add('loaded');
        }
    };

    const showLoader = (forceImmediate = false) => {
        // Só mostra o loader se for carregamento externo (F5/refresh)
        if (!forceImmediate) return;

        let preloader = document.getElementById('preloader');
        if (!preloader) {
            preloader = createLoader();
        }
        preloader.classList.remove('loaded');
    };

    const updateContent = (content) => {
        const mainContent = document.querySelector('main');
        if (mainContent) {
            // Fazemos uma transição suave
            mainContent.style.opacity = '0';
            setTimeout(() => {
                mainContent.innerHTML = content;
                mainContent.style.opacity = '1';
            }, 100);
        }
    };

    // 2. Verificação de primeiro carregamento
    const isFirstLoad = performance.navigation.type === 1 || !sessionStorage.getItem('notFirstLoad');

    // 3. Criação inicial do loader se necessário
    if (isFirstLoad) {
        cleanExistingLoaders();
        const loader = document.createElement('div');
        loader.id = 'preloader';
        loader.innerHTML = '<div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div>';
        document.body.appendChild(loader);
        
        // Garantimos que o loader será removido após o carregamento completo
        window.addEventListener('load', function() {
            hideLoader();
        }, { once: true }); // once: true garante que o evento só será executado uma vez
    }

    // 4. Setup dos eventos quando o DOM estiver pronto
    document.addEventListener('DOMContentLoaded', function() {
        // Marca que não é mais primeiro carregamento
        sessionStorage.setItem('notFirstLoad', 'true');

        // Expõe funções globalmente
        window.showLoader = showLoader;
        window.hideLoader = hideLoader;

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
                    // Atualiza apenas o conteúdo principal com transição suave
                    updateContent(html);
                    // Atualiza a URL sem recarregar
                    history.pushState({}, '', link.href);

                    // Atualiza as meta tags de SEO
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
                });
            }
        });

        window.addEventListener('popstate', function() {
            fetch(window.location.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                updateContent(html);
            });
        });
    });
})(); 