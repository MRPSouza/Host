document.addEventListener('DOMContentLoaded', function() {
    // Cache para armazenar os dados SEO
    let seoData = null;

    // Carregar dados SEO do JSON
    async function loadSeoData() {
        try {
            // Caminho a partir da pasta public
            const response = await fetch('../private/source/pages/data/seo_pages.json');
            seoData = await response.json();
        } catch (error) {
            console.error('Erro ao carregar dados SEO:', error);
        }
    }

    // Carregar dados SEO ao iniciar
    loadSeoData();

    // Interceptar cliques em links
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a[data-page]');
        if (!link) return;
        
        e.preventDefault();
        const page = link.getAttribute('data-page');
        navigateToPage(page);
    });

    // Função para navegar entre páginas
    async function navigateToPage(page) {
        try {
            // Verificar se a página existe no seoData
            if (!seoData || !seoData[page]) {
                window.location.href = '404.php';
                return;
            }

            // Adicionar classe de transição
            const contentDiv = document.querySelector('#content-dynamic');
            contentDiv.style.opacity = '0.6';
            contentDiv.style.transition = 'opacity 0.2s ease';

            // Fazer duas requisições: uma para o arquivo público e outra para o conteúdo
            const [publicResponse, contentResponse] = await Promise.all([
                fetch(`${page}.php`),
                fetch(`../private/source/pages/${page}.php`)
            ]);

            // Obter o conteúdo da página pública
            const publicHtml = await publicResponse.text();
            
            // Criar um DOM parser temporário
            const parser = new DOMParser();
            const doc = parser.parseFromString(publicHtml, 'text/html');
            
            // Atualizar o conteúdo dinâmico com o conteúdo do arquivo privado
            const contentHtml = await contentResponse.text();
            contentDiv.innerHTML = contentHtml;
            
            // Restaurar a opacidade
            setTimeout(() => {
                contentDiv.style.opacity = '1';
            }, 50);

            // Atualizar a URL sem recarregar a página
            history.pushState({page: page}, '', `${page}.php`);
            
            // Atualizar elementos do head
            updateHeadElements(page, seoData[page]);
            
        } catch (error) {
            console.error('Erro ao carregar a página:', error);
        }
    }

    // Função para atualizar elementos do head
    function updateHeadElements(page, pageData) {
        try {
            // Atualizar título
            document.getElementById('page-title').textContent = pageData.titulo_da_aba;
            
            // Atualizar meta tags
            document.getElementById('meta-robots').content = pageData.robots;
            document.getElementById('meta-googlebot').content = pageData.googlebot;
            document.getElementById('meta-googlebot-news').content = pageData.googlebot_news;
            document.getElementById('meta-keywords').content = pageData.meta_palavras_chaves;
            document.getElementById('meta-title').content = pageData.meta_titulo;
            document.getElementById('meta-description').content = pageData.meta_descricao;
            
            // Atualizar link canônico
            document.getElementById('canonical-link').href = pageData.link_canonico;
            
            // Atualizar CSS da página
            document.getElementById('page-css').href = `css/${page}.css`;
            
            // Atualizar Open Graph
            document.getElementById('og-title').content = pageData.meta_titulo;
            document.getElementById('og-description').content = pageData.meta_descricao;
            document.getElementById('og-url').content = pageData.link_canonico;
            document.getElementById('og-image').content = pageData.imagem_da_pagina_atual;
            document.getElementById('og-site-name').content = pageData.titulo_da_aba;
            
            // Atualizar Twitter Cards
            document.getElementById('twitter-title').content = pageData.meta_titulo;
            document.getElementById('twitter-description').content = pageData.meta_descricao;
            document.getElementById('twitter-image').content = pageData.imagem_da_pagina_atual;
            document.getElementById('twitter-url').content = pageData.link_canonico;
            
            // Atualizar Apple meta tags
            document.getElementById('apple-title').content = pageData.titulo_da_aba;
            document.getElementById('apple-image').href = pageData.imagem_da_pagina_atual;
        } catch (error) {
            console.error('Erro ao atualizar elementos do head:', error);
        }
    }

    // Lidar com navegação pelo botão voltar/avançar do navegador
    window.addEventListener('popstate', function(e) {
        if (e.state && e.state.page) {
            navigateToPage(e.state.page);
        }
    });
});
