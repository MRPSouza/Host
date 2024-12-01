// Executa antes do DOMContentLoaded
(function() {
    if (performance.navigation.type === 1 || !sessionStorage.getItem('notFirstLoad')) {
        // Esconde todo o conteúdo imediatamente
        document.write('<style>body > *:not(#preloader) { visibility: hidden !important; }</style>');
        document.write('<div id="preloader" style="position:fixed;top:0;left:0;width:100%;height:100%;background:#ffffff;display:flex;justify-content:center;align-items:center;z-index:999999;opacity:1"><div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div></div>');
    }
})();

document.addEventListener('DOMContentLoaded', function() {
    let preloader = document.getElementById('preloader');
    const mainContent = document.querySelector('main');
    let loadTimer = null;
    let isFirstLoad = !sessionStorage.getItem('notFirstLoad');
    
    sessionStorage.setItem('notFirstLoad', 'true');
    
    // Função para criar o loader
    const createLoader = () => {
        // Esconde todo o conteúdo
        document.body.style.visibility = 'hidden';
        
        const loader = document.createElement('div');
        loader.id = 'preloader';
        loader.innerHTML = '<div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div>';
        document.body.appendChild(loader);
        
        // Garante que apenas o loader está visível
        loader.style.visibility = 'visible';
        return loader;
    };
    
    if (!preloader) {
        preloader = createLoader();
    }
    
    window.showLoader = function(forceImmediate = false) {
        if (loadTimer) clearTimeout(loadTimer);
        
        const showLoaderContent = () => {
            document.body.style.visibility = 'hidden';
            if (!document.getElementById('preloader')) {
                preloader = createLoader();
            }
            preloader.style.display = 'flex';
            preloader.style.visibility = 'visible';
            requestAnimationFrame(() => {
                preloader.style.opacity = '1';
            });
        };
        
        if (forceImmediate) {
            showLoaderContent();
        } else {
            loadTimer = setTimeout(showLoaderContent, 2000);
        }
    }
    
    window.hideLoader = function() {
        if (loadTimer) {
            clearTimeout(loadTimer);
            loadTimer = null;
        }
        
        const currentLoader = document.getElementById('preloader');
        if (currentLoader) {
            currentLoader.style.opacity = '0';
            setTimeout(() => {
                currentLoader.remove();
                // Remove o estilo inline e a regra de estilo inicial
                document.body.removeAttribute('style');
                const styleTag = document.querySelector('style');
                if (styleTag && styleTag.textContent.includes('body > *:not(#preloader)')) {
                    styleTag.remove();
                }
                // Garante que todo o conteúdo está visível e interativo
                document.querySelectorAll('body > *').forEach(el => {
                    el.style.visibility = 'visible';
                    el.style.pointerEvents = 'auto';
                });
                if(mainContent) mainContent.classList.add('content-loaded');
            }, 300);
        } else {
            // Garante que todo o conteúdo está visível e interativo mesmo sem loader
            document.body.removeAttribute('style');
            document.querySelectorAll('body > *').forEach(el => {
                el.style.visibility = 'visible';
                el.style.pointerEvents = 'auto';
            });
        }
    }
    
    // No primeiro carregamento ou reload completo, mostra o loader imediatamente
    if (isFirstLoad || performance.navigation.type === 1) {
        showLoader(true);
    }
    
    // Esconde o loader quando a página terminar de carregar
    window.addEventListener('load', hideLoader);
    
    // Intercepta cliques em links
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && 
            !link.target && 
            !e.ctrlKey && 
            !e.shiftKey && 
            !link.hasAttribute('download') && 
            link.href.indexOf('tel:') !== 0 && 
            link.href.indexOf('mailto:') !== 0) {
            
            const isFullPageLoad = !link.hasAttribute('data-ajax');
            showLoader(isFullPageLoad);
        }
    });

    // Esconde o loader se a navegação for cancelada
    window.addEventListener('popstate', hideLoader);
}); 