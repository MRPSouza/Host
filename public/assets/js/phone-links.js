// Intercepta todos os cliques em links do menu
document.querySelectorAll('nav a').forEach(link => {
    link.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        
        // Ignora links telefônicos
        if (href.startsWith('tel:')) {
            return; // Permite o comportamento padrão do link
        }

        e.preventDefault();
        loadContent(href);
    });
}); 