document.addEventListener('DOMContentLoaded', function() {
    const preloader = document.getElementById('preloader');
    const mainContent = document.querySelector('main');
    let loadTimer = null;
    
    // Inicialmente esconde o preloader
    preloader.style.display = 'none';
    
    // Função para mostrar o loader
    window.showLoader = function() {
        // Limpa timer existente se houver
        if (loadTimer) clearTimeout(loadTimer);
        
        // Não mostra o loader imediatamente
        preloader.style.opacity = '0';
        
        // Inicia um novo timer de 2 segundos
        loadTimer = setTimeout(() => {
            preloader.style.display = 'flex';
            // Pequeno timeout para garantir que o display:flex seja aplicado antes da transição
            requestAnimationFrame(() => {
                preloader.style.opacity = '1';
            });
            if(mainContent) mainContent.classList.remove('content-loaded');
        }, 2000);
    }
    
    // Função para esconder o loader
    window.hideLoader = function() {
        // Limpa o timer se existir
        if (loadTimer) {
            clearTimeout(loadTimer);
            loadTimer = null;
        }
        
        // Esconde o loader com fade
        preloader.style.opacity = '0';
        setTimeout(() => {
            preloader.style.display = 'none';
            if(mainContent) mainContent.classList.add('content-loaded');
        }, 300); // Tempo da transição
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
            showLoader();
        }
    });

    // Esconde o loader se a navegação for cancelada
    window.addEventListener('popstate', hideLoader);
}); 