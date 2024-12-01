// Executa antes do DOMContentLoaded para garantir que o loader apareça primeiro
(function() {
    if (performance.navigation.type === 1 || !sessionStorage.getItem('notFirstLoad')) {
        document.write('<div id="preloader" style="position:fixed;top:0;left:0;width:100%;height:100%;background:#ffffff;display:flex;justify-content:center;align-items:center;z-index:999999;opacity:1"><div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div></div>');
    }
})();

document.addEventListener('DOMContentLoaded', function() {
    const preloader = document.getElementById('preloader');
    const mainContent = document.querySelector('main');
    let loadTimer = null;
    let isFirstLoad = !sessionStorage.getItem('notFirstLoad');
    
    sessionStorage.setItem('notFirstLoad', 'true');
    
    // Se o preloader não foi criado pelo script inicial, cria agora
    if (!preloader) {
        const loader = document.createElement('div');
        loader.id = 'preloader';
        loader.innerHTML = '<div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div>';
        document.body.appendChild(loader);
    }
    
    // Função para mostrar o loader
    window.showLoader = function(forceImmediate = false) {
        if (loadTimer) clearTimeout(loadTimer);
        
        if (forceImmediate) {
            preloader.style.removeProperty('visibility');
            preloader.style.display = 'flex';
            requestAnimationFrame(() => {
                preloader.style.opacity = '1';
            });
            if(mainContent) mainContent.classList.remove('content-loaded');
            return;
        }
        
        preloader.style.opacity = '0';
        loadTimer = setTimeout(() => {
            preloader.style.removeProperty('visibility');
            preloader.style.display = 'flex';
            requestAnimationFrame(() => {
                preloader.style.opacity = '1';
            });
            if(mainContent) mainContent.classList.remove('content-loaded');
        }, 2000);
    }
    
    // Função para esconder o loader
    window.hideLoader = function() {
        if (loadTimer) {
            clearTimeout(loadTimer);
            loadTimer = null;
        }
        
        preloader.style.opacity = '0';
        setTimeout(() => {
            preloader.style.display = 'none';
            preloader.style.visibility = 'hidden';
            if(mainContent) mainContent.classList.add('content-loaded');
        }, 300);
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
            
            // Verifica se é uma navegação para uma nova página (não AJAX)
            const isFullPageLoad = !link.hasAttribute('data-ajax');
            showLoader(isFullPageLoad);
        }
    });

    // Esconde o loader se a navegação for cancelada
    window.addEventListener('popstate', hideLoader);
}); 