document.addEventListener('DOMContentLoaded', function() {
    // Obtém o BASE_URL do meta tag ou define um padrão
    const BASE_URL = document.querySelector('meta[name="base-url"]')?.content || '';

    // Função para atualizar as meta tags de SEO
    function updateSEO(html) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const seoData = doc.querySelector('seo-data');
        if (seoData) {
            const head = document.querySelector('head');
            // Remove as meta tags antigas de SEO
            head.querySelectorAll('meta[name="description"], meta[name="keywords"], title, meta[property^="og:"]').forEach(el => el.remove());
            
            // Adiciona apenas as novas meta tags de SEO
            const seoContent = seoData.innerHTML;
            head.insertAdjacentHTML('afterbegin', seoContent);
        }
    }

    // Função para atualizar CSS e JS
    function updateAssets(html) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // Obtém os novos links e scripts
        const newLinks = Array.from(doc.querySelectorAll('link[rel="stylesheet"]:not([data-global])'));
        const newScripts = Array.from(doc.querySelectorAll('script[src]:not([data-global])'));
        
        const head = document.querySelector('head');
        
        // Obtém os links e scripts atuais não globais
        const currentLinks = Array.from(head.querySelectorAll('link[rel="stylesheet"]:not([data-global])'));
        const currentScripts = Array.from(head.querySelectorAll('script[src]:not([data-global])'));

        // Remove apenas os recursos que não estão na nova página
        currentLinks.forEach(link => {
            const exists = newLinks.some(newLink => newLink.href === link.href);
            if (!exists) {
                link.remove();
            }
        });

        currentScripts.forEach(script => {
            const exists = newScripts.some(newScript => newScript.src === script.src);
            if (!exists) {
                script.remove();
            }
        });

        // Adiciona apenas os novos recursos que ainda não existem
        newLinks.forEach(link => {
            const exists = currentLinks.some(currentLink => currentLink.href === link.href);
            if (!exists) {
                head.appendChild(link.cloneNode(true));
            }
        });

        newScripts.forEach(script => {
            const exists = currentScripts.some(currentScript => currentScript.src === script.src);
            if (!exists) {
                const newScript = document.createElement('script');
                newScript.src = script.src;
                if (script.hasAttribute('defer')) newScript.defer = true;
                if (script.hasAttribute('async')) newScript.async = true;
                head.appendChild(newScript);
            }
        });
    }

    // Função para reinicializar scripts decorativos
    function reinitializeScripts() {
        // Reinicializa o desktop.js se estiver na página inicial
        if (window.location.pathname === '/' || window.location.pathname === '/index.php') {
            const taskbarTime = document.getElementById('taskbar-time');
            if (taskbarTime) {
                // Reinicializa o relógio
                const updateClock = () => {
                    taskbarTime.textContent = new Date().toLocaleTimeString();
                };
                updateClock();
                setInterval(updateClock, 1000);
            }

            // Reinicializa os eventos de arrastar e soltar
            const desktop = document.getElementById('desktop');
            const icons = document.querySelectorAll('.desktop-icon');
            if (desktop && icons.length > 0) {
                icons.forEach(icon => {
                    icon.addEventListener('dragstart', function(e) {
                        e.dataTransfer.setData('text/plain', '');
                        this.classList.add('dragging');
                    });

                    icon.addEventListener('dragend', function() {
                        this.classList.remove('dragging');
                        saveIconPositions();
                    });
                });

                // Carrega posições salvas dos ícones
                loadIconPositions();
            }
        }
    }

    // Função para carregar e executar scripts específicos da página
    function loadPageScripts(html) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const path = window.location.pathname;

        // Remove scripts antigos específicos da página
        document.querySelectorAll('script:not([data-global])').forEach(script => script.remove());

        // Carrega os novos scripts específicos
        if (path === '/' || path === '/index.php') {
            // Scripts da página inicial
            loadScript(BASE_URL + '/assets/js/home.js').then(() => {
                // Executa a inicialização após carregar o script
                if (typeof initializeTextAnimation === 'function') {
                    initializeTextAnimation();
                }
            });
        } else if (path.includes('/contato')) {
            // Scripts da página de contato
            loadScript(BASE_URL + '/assets/js/contact.js');
        } else if (path.includes('/servicos')) {
            // Scripts da página de serviços
            loadScript(BASE_URL + '/assets/js/services.js');
        }
    }

    // Função para carregar um script
    function loadScript(url) {
        return new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = url;
            script.onload = resolve;
            script.onerror = reject;
            document.body.appendChild(script);
        });
    }

    // Intercepta cliques em links para navegação AJAX
    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && 
            !link.target && 
            !e.ctrlKey && 
            !e.shiftKey && 
            !link.hasAttribute('download') && 
            link.href.indexOf('tel:') !== 0 && 
            link.href.indexOf('mailto:') !== 0) {
            
            e.preventDefault();
            
            fetch(link.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                updateSEO(html);
                updateAssets(html);
                history.pushState({}, '', link.href);
                loadPageScripts(html);
            });
        }
    });

    // Atualiza ao usar o botão voltar do navegador
    window.addEventListener('popstate', function() {
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            updateSEO(html);
            updateAssets(html);
            loadPageScripts(html);
        });
    });
});