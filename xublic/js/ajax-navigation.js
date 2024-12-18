document.addEventListener('DOMContentLoaded', function() {
    const loader = document.querySelector('.loader-wrapper');
    const navbar = document.querySelector('.navbar-collapse');
    let isFirstLoad = true;
    
    // Remove o loader crítico e mostra o conteúdo quando tudo estiver pronto
    window.addEventListener('load', function() {
        setTimeout(() => {
            // Remove a classe loading do HTML
            document.documentElement.classList.remove('loading');
            
            // Remove o loader crítico
            const criticalLoader = document.querySelector('.critical-loader');
            if (criticalLoader) {
                criticalLoader.remove();
            }

            // Remove o loader normal após a primeira carga
            if (loader && isFirstLoad) {
                loader.classList.remove('first-load');
                document.body.classList.add('loaded');
                isFirstLoad = false;
            }
        }, 500);
    });

    function loadContent(href) {
        // Ignora se for apenas mudança de hash
        if (href.includes('#')) return;
        
        // Fecha o navbar mobile após clicar
        if (navbar && navbar.classList.contains('show')) {
            // Usa o data-bs-toggle para fechar
            const toggler = document.querySelector('.navbar-toggler');
            if (toggler && !toggler.classList.contains('collapsed')) {
                toggler.click();
            }
        }
        
        href = href.replace(/([^:]\/)\/+/g, "$1");
        
        fetch(href, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.text();
        })
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            const mainContent = doc.querySelector('main');
            if (mainContent) {
                const currentMain = document.querySelector('main');
                if (currentMain) {
                    currentMain.innerHTML = mainContent.innerHTML;
                }
            }
            
            const seoData = doc.querySelector('seo-data');
            if (seoData) {
                try {
                    const seoJson = JSON.parse(seoData.textContent);
                    updateSEO(seoJson);
                } catch (e) {
                    console.error('Erro ao processar dados SEO:', e);
                }
            }
            
            window.history.pushState({}, '', href);
            
            document.querySelectorAll('nav a').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === href) {
                    link.classList.add('active');
                }
            });
        })
        .catch(error => {
            console.error('Erro no carregamento:', error);
        });
    }

    // Intercepta cliques em links
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && link.href && link.href.includes(window.location.host)) {
            e.preventDefault();
            loadContent(link.href);
        }
    });

    // Gerencia navegação do histórico
    window.addEventListener('popstate', function() {
        loadContent(window.location.href);
    });
});

function updateSEO(seoData) {
    if (!seoData) return;
    
    const head = document.querySelector('head');
    head.querySelectorAll('meta[name="description"], meta[name="keywords"], meta[property^="og:"], link[rel="canonical"]')
        .forEach(el => el.remove());
    
    if (seoData.title) document.title = seoData.title;
}