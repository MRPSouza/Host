// Executa antes do DOMContentLoaded
(function() {
    if (performance.navigation.type === 1 || !sessionStorage.getItem('notFirstLoad')) {
        // Removemos o style inline que estava afetando a interatividade
        document.write('<div id="preloader"><div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div></div>');
    }
})();

document.addEventListener('DOMContentLoaded', function() {
    let preloader = document.getElementById('preloader');
    let loadTimer = null;
    let isFirstLoad = !sessionStorage.getItem('notFirstLoad');
    
    sessionStorage.setItem('notFirstLoad', 'true');
    
    const createLoader = () => {
        const loader = document.createElement('div');
        loader.id = 'preloader';
        loader.innerHTML = '<div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div>';
        document.body.appendChild(loader);
        return loader;
    };
    
    if (!preloader) {
        preloader = createLoader();
    }
    
    window.showLoader = function(forceImmediate = false) {
        if (loadTimer) clearTimeout(loadTimer);
        
        const showLoaderContent = () => {
            if (!document.getElementById('preloader')) {
                preloader = createLoader();
            }
            preloader.style.display = 'flex';
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
            currentLoader.style.display = 'none';
            // Garantimos que o body e seus elementos estão interativos
            document.body.style.pointerEvents = 'auto';
        }
    }
    
    // Se for F5, garantimos que o body está interativo após o carregamento
    if (performance.navigation.type === 1) {
        document.body.style.pointerEvents = 'auto';
    }
    
    if (isFirstLoad || performance.navigation.type === 1) {
        showLoader(true);
    }
    
    window.addEventListener('load', hideLoader);
    
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

    window.addEventListener('popstate', hideLoader);
}); 