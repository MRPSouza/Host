document.addEventListener('DOMContentLoaded', function() {
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
                // Atualiza as meta tags de SEO
                updateSEO(html);
                // Atualiza CSS e JS
                updateAssets(html);
                // Reinicializa scripts após a atualização do conteúdo
                setTimeout(reinitializeScripts, 100);
            });
        }
    });

    // Atualiza SEO ao usar o botão voltar do navegador
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
            // Reinicializa scripts após a atualização do conteúdo
            setTimeout(reinitializeScripts, 100);
        });
    });
});