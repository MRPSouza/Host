document.addEventListener('DOMContentLoaded', function() {
    const preloader = document.getElementById('preloader');
    const mainContent = document.querySelector('main');
    let loadTimer = null;
    let isFirstLoad = !sessionStorage.getItem('notFirstLoad');
    
    // Marca que não é mais o primeiro carregamento
    sessionStorage.setItem('notFirstLoad', 'true');
    
    // Inicialmente esconde o preloader, exceto no primeiro carregamento
    if (isFirstLoad) {
        preloader.style.display = 'flex';
        preloader.style.opacity = '1';
    } else {
        preloader.style.display = 'none';
    }
    
    // Função para mostrar o loader
    window.showLoader = function(forceImmediate = false) {
        // Limpa timer existente se houver
        if (loadTimer) clearTimeout(loadTimer);
        
        // Se for forçado ou primeiro carregamento, mostra imediatamente
        if (forceImmediate) {
            preloader.style.display = 'flex';
            requestAnimationFrame(() => {
                preloader.style.opacity = '1';
            });
            if(mainContent) mainContent.classList.remove('content-loaded');
            return;
        }
        
        // Comportamento normal para navegações subsequentes
        preloader.style.opacity = '0';
        loadTimer = setTimeout(() => {
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