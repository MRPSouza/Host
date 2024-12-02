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

    // 2. Verificação de primeiro carregamento
    const isFirstLoad = performance.navigation.type === 1 || !sessionStorage.getItem('notFirstLoad');

    // 3. Criação inicial do loader se necessário
    if (isFirstLoad) {
        cleanExistingLoaders();
        const loaderHtml = '<div id="preloader"><div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div></div>';
        document.write(loaderHtml);
        
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

        // Removido o evento de click para links internos
        window.addEventListener('load', hideLoader);
        window.addEventListener('popstate', hideLoader);
    });
})(); 