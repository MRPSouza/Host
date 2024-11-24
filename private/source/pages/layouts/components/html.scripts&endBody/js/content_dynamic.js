document.addEventListener("DOMContentLoaded", function() {
    let t = document.getElementById("content-dynamic"),
        e = {};

    function n(n) {
        console.log("Tentando carregar página:", n);
        console.log("Dados disponíveis:", e[n]);
        let a = e[n];
        if (!a) {
            console.error("Página não encontrada:", n);
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
        fetch(`../private/source/pages/${n}.php`).then(t => t.text()).then(e => {
            var o;
            t.innerHTML = e, o = a,
                document.getElementById("page-title").textContent = o.titulo_da_aba,
                document.getElementById("meta-robots").setAttribute("content", o.robots),
                document.getElementById("meta-googlebot").setAttribute("content", o.googlebot),
                document.getElementById("meta-googlebot-news").setAttribute("content", o.googlebot_news),
                document.getElementById("meta-keywords").setAttribute("content", o.meta_palavras_chaves),
                document.getElementById("meta-title").setAttribute("content", o.meta_titulo),
                document.getElementById("meta-description").setAttribute("content", o.meta_descricao),
                document.getElementById("canonical-link").setAttribute("href", o.link_canonico),
                document.getElementById("page-css").setAttribute("href", `css/${o.extension.replace(".php", ".css")}`),
                document.getElementById("og-title").setAttribute("content", o.meta_titulo),
                document.getElementById("og-description").setAttribute("content", o.meta_descricao),
                document.getElementById("og-url").setAttribute("content", o.link_canonico),
                document.getElementById("og-image").setAttribute("content", o.imagem_da_pagina_atual),
                document.getElementById("og-site-name").setAttribute("content", o.meta_titulo),
                document.getElementById("twitter-title").setAttribute("content", o.meta_titulo),
                document.getElementById("twitter-description").setAttribute("content", o.meta_descricao),
                document.getElementById("twitter-image").setAttribute("content", o.imagem_da_pagina_atual),
                document.getElementById("twitter-url").setAttribute("content", o.link_canonico),
                document.getElementById("apple-title").setAttribute("content", o.meta_titulo),
                document.getElementById("apple-image").setAttribute("href", o.imagem_da_pagina_atual),
                newUrl = n === 'index' ? 'index/../' : `${n}`;
                history.pushState({
                    page: n
                }, "", newUrl),
                console.log("Página carregada e meta tags atualizadas:", n)
        }).catch(e => {
            console.error("Erro ao carregar a página:", e), t.innerHTML = "<p>Erro ao carregar a página</p>";

        })
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
        .then(t => t.json())
        .then(t => {
            e = t;
            checkAndPerformSearch();
            let a = window.location.pathname.split("/").pop() || "index";
            a = a.replace('.php', '');
            if (!a || a === '/') a = "index";
            if (!window.location.search) {
                n(a);
            }
        }).catch(t => console.error("Erro ao carregar seo_pages.json:", t)),
    
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
