document.addEventListener('DOMContentLoaded', function() {
    const preloader = document.getElementById('preloader');
    const mainContent = document.querySelector('main');
    
    // Função para mostrar o loader
    window.showLoader = function() {
        preloader.style.display = 'flex';
        preloader.classList.remove('loaded');
        if(mainContent) mainContent.classList.remove('content-loaded');
    }
    
    // Função para esconder o loader
    window.hideLoader = function() {
        preloader.classList.add('loaded');
        if(mainContent) mainContent.classList.add('content-loaded');
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500);
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
}); 