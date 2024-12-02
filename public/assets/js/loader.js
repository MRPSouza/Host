(function() {
    // 1. Definição das funções principais
    const createLoader = () => {
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
        let preloader = document.getElementById('preloader');
        if (!preloader) {
            preloader = createLoader();
        }
        preloader.classList.remove('loaded');
    };

    // 2. Verificação de primeiro carregamento
    const isFirstLoad = performance.navigation.type === 1 || !sessionStorage.getItem('notFirstLoad');

    // 3. Criação inicial do loader se necessário
    if (isFirstLoad) {
        const loaderHtml = '<div id="preloader"><div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div></div>';
        document.write(loaderHtml);
    }

    // 4. Setup dos eventos quando o DOM estiver pronto
    document.addEventListener('DOMContentLoaded', function() {
        // Marca que não é mais primeiro carregamento
        sessionStorage.setItem('notFirstLoad', 'true');

        // Expõe funções globalmente
        window.showLoader = showLoader;
        window.hideLoader = hideLoader;

        // Configura eventos de navegação
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && 
                !link.target && 
                !e.ctrlKey && 
                !e.shiftKey && 
                !link.hasAttribute('download') && 
                link.href.indexOf('tel:') !== 0 && 
                link.href.indexOf('mailto:') !== 0) {
                
                showLoader(!link.hasAttribute('data-ajax'));
            }
        });

        // Esconde o loader quando a página terminar de carregar
        window.addEventListener('load', hideLoader);
        window.addEventListener('popstate', hideLoader);
    });
})(); 