document.addEventListener('DOMContentLoaded', function() {
    const preloader = document.getElementById('preloader');
    const mainContent = document.querySelector('main');
    let loadTimer = null;
    
    // Função para mostrar o loader
    window.showLoader = function() {
        // Limpa timer existente se houver
        if (loadTimer) clearTimeout(loadTimer);
        
        // Inicia um novo timer de 2 segundos
        loadTimer = setTimeout(() => {
            preloader.style.display = 'flex';
            preloader.classList.remove('loaded');
            if(mainContent) mainContent.classList.remove('content-loaded');
        }, 2000); // 2 segundos
    }
    
    // Função para esconder o loader
    window.hideLoader = function() {
        // Limpa o timer se existir
        if (loadTimer) {
            clearTimeout(loadTimer);
            loadTimer = null;
        }
        
        // Esconde o loader se estiver visível
        if (preloader.style.display === 'flex') {
            preloader.classList.add('loaded');
            if(mainContent) mainContent.classList.add('content-loaded');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        } else {
            // Se o loader não chegou a aparecer, apenas garante que está escondido
            preloader.style.display = 'none';
            if(mainContent) mainContent.classList.add('content-loaded');
        }
    }
    
    // Esconde o loader quando a página terminar de carregar
    window.addEventListener('load', function() {
        hideLoader();
    });
    
    // Mostra o loader antes de navegar para outra página
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && !link.target && !e.ctrlKey && !e.shiftKey) {
            showLoader();
        }
    });

    // Esconde o loader se a navegação for cancelada
    window.addEventListener('popstate', function() {
        hideLoader();
    });
}); 