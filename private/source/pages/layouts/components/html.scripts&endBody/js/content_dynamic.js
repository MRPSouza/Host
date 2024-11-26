document.addEventListener("DOMContentLoaded", function() {
    let t = document.getElementById("content-dynamic"),
        e = {};

    function n(n) {
        if (!n) {
            console.error("Nome da página não fornecido");
            return;
        }
        
        fetch(`/page_loader.php?page=${encodeURIComponent(n)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(e => {
                t.innerHTML = e;
                updateMetaTags(a);
                checkImageLoading();
                let newUrl = n === 'index' ? '/' : `/${n}`;
                history.pushState({page: n}, "", newUrl);
                console.log("Página carregada e meta tags atualizadas:", n)
            })
            .catch(error => {
                console.error("Erro ao carregar a página:", error);
                t.innerHTML = "<p>Erro ao carregar a página</p>";
            });
    }

    function updateMetaTags(o) {
        console.log("Iniciando atualização de meta tags com dados:", o);
        
        const elements = {
            "page-title": ["titulo_da_aba", "textContent"],
            "meta-robots": ["robots", "content"],
            "meta-googlebot": ["googlebot", "content"],
            "meta-googlebot-news": ["googlebot_news", "content"],
            "meta-keywords": ["meta_palavras_chaves", "content"],
            "meta-title": ["meta_titulo", "content"],
            "meta-description": ["meta_descricao", "content"],
            "canonical-link": ["link_canonico", "href"],
            "current-css": ["extension", "href"],
            "og-title": ["meta_titulo", "content"],
            "og-description": ["meta_descricao", "content"],
            "og-url": ["link_canonico", "content"],
            "og-image": ["imagem_da_pagina_atual", "content"],
            "og-site-name": ["titulo_da_aba", "content"],
            "twitter-title": ["meta_titulo", "content"],
            "twitter-description": ["meta_descricao", "content"],
            "twitter-image": ["imagem_da_pagina_atual", "content"],
            "twitter-url": ["link_canonico", "content"],
            "apple-title": ["titulo_da_aba", "content"],
            "apple-image": ["imagem_da_pagina_atual", "href"]
        };

        for (const [id, [jsonKey, attribute]] of Object.entries(elements)) {
            const element = document.getElementById(id);
            console.log(`Procurando elemento com ID '${id}'`, element ? 'encontrado' : 'não encontrado');
            
            if (element) {
                let value;
                if (id === "current-css") {
                    value = `/css/${o[jsonKey].replace(".php", ".css")}`;
                } else if (id.includes("image")) {
                    value = o[jsonKey] ? `/img/${o[jsonKey]}` : '';
                    console.log(`Processando imagem ${id}:`, value);
                } else {
                    value = o[jsonKey] || '';
                }
                if (value) {
                    try {
                        element.setAttribute(attribute, value);
                        console.log(`✅ Atualizado ${id} com ${value}`);
                    } catch (error) {
                        console.error(`❌ Erro ao atualizar ${id}:`, error);
                    }
                } else {
                    console.warn(`⚠️ Valor vazio para ${id}`);
                }
            }
        }
    }

    function checkImageLoading() {
        document.querySelectorAll('img').forEach(img => {
            if (img.src.includes('%20')) {
                img.src = img.src.replace(/%20/g, '-').toLowerCase();
            }
            
            img.onerror = function() {
                console.error(`Erro ao carregar imagem: ${img.src}`);
                img.src = '/img/default.png';
            };
            
            img.onload = function() {
                console.log(`Imagem carregada com sucesso: ${img.src}`);
            };
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
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (!data) {
                throw new Error('Dados SEO não encontrados');
            }
            console.log("Dados disponíveis:", data);
            e = data;
            checkAndPerformSearch();
            let a = window.location.pathname.split("/").pop() || "index";
            a = a.replace('.php', '');
            if (!a || a === '/') a = "index";
            if (!window.location.search) {
                n(a);
            }
        }).catch(error => {
            console.error("Erro ao carregar seo_pages.json:", error);
            // Tratamento de fallback
            t.innerHTML = "<p>Erro ao carregar o conteúdo</p>";
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
