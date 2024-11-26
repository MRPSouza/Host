document.addEventListener("DOMContentLoaded", function() {
    let t = document.getElementById("content-dynamic"),
        e = {};

    function n(pageName) {
        console.log("Tentando carregar página:", pageName);
        console.log("Dados disponíveis:", e[pageName]);
        let a = e[pageName];
        
        if (!a) {
            console.error("Página não encontrada:", pageName);
            fetch(`../private/source/pages/404.php`).then(t => t.text()).then(e => {
                t.innerHTML = e;
                history.pushState({page: '404'}, "", '404');
                console.log("Página 404 carregada");
            }).catch(e => {
                console.error("Erro ao carregar a página 404:", e);
                t.innerHTML = "<p>Erro ao carregar a página</p>";
            });
            return;
        }

        fetch(`../private/source/pages/${pageName}/${pageName}.php`)
            .then(t => t.text())
            .then(content => {
                t.innerHTML = content;
                if (e[pageName]) {
                    const pageData = e[pageName];
                    document.getElementById("page-title").textContent = pageData.titulo_da_aba;
                    document.getElementById("meta-robots").setAttribute("content", pageData.robots);
                    document.getElementById("meta-googlebot").setAttribute("content", pageData.googlebot);
                    document.getElementById("meta-googlebot-news").setAttribute("content", pageData.googlebot_news);
                    document.getElementById("meta-keywords").setAttribute("content", pageData.meta_palavras_chaves);
                    document.getElementById("meta-title").setAttribute("content", pageData.meta_titulo);
                    document.getElementById("meta-description").setAttribute("content", pageData.meta_descricao);
                    document.getElementById("canonical-link").setAttribute("href", pageData.link_canonico);
                    document.getElementById("page-css").setAttribute("href", `css/${pageName}.css`);
                    document.getElementById("og-title").setAttribute("content", pageData.meta_titulo);
                    document.getElementById("og-description").setAttribute("content", pageData.meta_descricao);
                    document.getElementById("og-url").setAttribute("content", pageData.link_canonico);
                    document.getElementById("og-image").setAttribute("content", pageData.imagem_da_pagina_atual);
                    document.getElementById("og-site-name").setAttribute("content", pageData.meta_titulo);
                    document.getElementById("twitter-title").setAttribute("content", pageData.meta_titulo);
                    document.getElementById("twitter-description").setAttribute("content", pageData.meta_descricao);
                    document.getElementById("twitter-image").setAttribute("content", pageData.imagem_da_pagina_atual);
                    document.getElementById("twitter-url").setAttribute("content", pageData.link_canonico);
                    document.getElementById("apple-title").setAttribute("content", pageData.meta_titulo);
                    document.getElementById("apple-image").setAttribute("href", pageData.imagem_da_pagina_atual);
                    const newUrl = pageName === 'index' ? '/' : `/${pageName}`;
                    history.pushState({
                        page: pageName
                    }, "", newUrl);
                    console.log("Página carregada e meta tags atualizadas:", pageName);
                }
            })
            .catch(error => {
                console.error("Erro ao carregar a página:", error);
                n('404');
            });
    }

    let pesquisaEmAndamento = false;

    function realizarPesquisa(termo) {
        if (pesquisaEmAndamento) return;
        pesquisaEmAndamento = true;
        console.log("Iniciando pesquisa para:", termo);
        fetch(`../public/search_engine.php?q=${encodeURIComponent(termo)}`)
            .then(response => response.json())
            .then(data => {
                carregarResultados(data);
                pesquisaEmAndamento = false;
            })
            .catch(error => {
                console.error('Erro na pesquisa:', error);
                pesquisaEmAndamento = false;
            });
    }

    function carregarResultados(data) {
        console.log("Carregando resultados da pesquisa");
        t.innerHTML = data.html;
        console.log("Resultados da pesquisa carregados e inseridos no DOM");
    }

    function checkAndPerformSearch() {
        const urlParams = new URLSearchParams(window.location.search);
        const searchTerm = urlParams.get('q');
        if (searchTerm) {
            realizarPesquisa(searchTerm);
        }
    }

    fetch(window.location.pathname + "?get_seo_data=1")
        .then(response => response.json())
        .then(data => {
            console.log("Dados SEO carregados:", data);
            e = data;
            
            let currentPath = window.location.pathname.substring(1) || 'index';
            currentPath = currentPath.replace(/\/$/, '').replace('.php', '');
            
            console.log("Caminho atual:", currentPath);
            
            if (window.location.search) {
                checkAndPerformSearch();
            } 
            else if (e[currentPath]) {
                console.log("Carregando página:", currentPath);
                n(currentPath);
            } 
            else if (currentPath !== 'index') {
                console.log("Página não encontrada, carregando 404");
                n('404');
            }
        })
        .catch(error => {
            console.error("Erro ao carregar dados SEO:", error);
            n('404');
        });
    
    document.body.addEventListener("click", function(t) {
        let e = t.target.closest("a[data-page]");
        if (e) {
            t.preventDefault();
            let a = e.getAttribute("data-page");
            n(a)
        }
    });

    // Adicionar event listener para o formulário de pesquisa
    let searchForm = document.querySelector('form[role="search"]');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            let searchTerm = this.querySelector('input[type="search"]').value;
            realizarPesquisa(searchTerm);
        });
    }

    window.addEventListener("popstate", function(t) {
        if (t.state && t.state.page) {
            n(t.state.page);
        } else if (t.state && t.state.search) {
            realizarPesquisa(t.state.search);
        } else {
            checkAndPerformSearch();
        }
    })

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    const realizarPesquisaDebounced = debounce(realizarPesquisa, 300);

    // Use realizarPesquisaDebounced em vez de realizarPesquisa nos event listeners
});
