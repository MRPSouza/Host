<script>
    // Função para carregar CSS dinamicamente com fallback para vendor local
    function loadCSS(url) {
        return new Promise((resolve, reject) => {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = url;
            
            link.onerror = () => {
                console.warn(`Falha ao carregar CSS: ${url}, tentando CDN alternativo...`);
                // Tenta primeiro CDN alternativo
                const newUrl = url.replace('jsdelivr.net', 'cdnjs.cloudflare.com');
                link.href = newUrl;
                
                // Se falhar novamente, tenta vendor local
                link.onerror = () => {
                    console.warn(`Falha no CDN alternativo, tentando vendor local...`);
                    const localPath = url.replace('https://cdn.jsdelivr.net/npm/', '/assets/vendor/');
                    link.href = localPath;
                    
                    // Se ainda falhar, registra erro
                    link.onerror = () => {
                        console.error(`Falha ao carregar CSS de todas as fontes: ${url}`);
                        reject();
                    };
                };
            };

            link.onload = resolve;
            document.head.appendChild(link);
        });
    }

    // CSS essenciais (carregamento imediato)
    const criticalCssFiles = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css',
        'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css'
    ];

    // CSS não essenciais (carregamento posterior)
    const nonCriticalCssFiles = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap-grid.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap-reboot.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap-utilities.min.css'
    ];

    // Carrega CSS críticos imediatamente
    criticalCssFiles.forEach(url => {
        requestAnimationFrame(() => loadCSS(url));
    });

    // Carrega CSS não críticos depois que a página carregar
    window.addEventListener('load', () => {
        requestIdleCallback(() => {
            nonCriticalCssFiles.forEach(url => loadCSS(url));
        });
    });

    // Função para verificar se um script já está carregado
    function isScriptLoaded(url) {
        return Array.from(document.scripts).some(script => script.src === url);
    }

    // Função para carregar JavaScript dinamicamente com fallback
    function loadScript(url) {
        return new Promise((resolve, reject) => {
            if (isScriptLoaded(url)) {
                resolve();
                return;
            }

            const script = document.createElement('script');
            script.src = url;
            script.async = true;
            script.defer = true;
            script.fetchPriority = 'high';
            
            script.onerror = () => {
                console.warn(`Falha ao carregar JS: ${url}, tentando vendor local...`);
                // Tenta carregar do vendor local
                const localPath = url.replace('https://cdn.jsdelivr.net/npm/', '/assets/vendor/');
                script.src = localPath;
                
                script.onerror = () => {
                    console.error(`Falha ao carregar JS de todas as fontes: ${url}`);
                    reject();
                };
            };
            
            script.onload = resolve;
            document.body.appendChild(script);
        });
    }

    // Array com os scripts essenciais
    const jsFiles = [
        'https://code.jquery.com/jquery-3.7.1.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'
    ];

    // Otimização do carregamento sequencial
    async function loadScriptsSequentially() {
        try {
            // Carrega scripts críticos primeiro
            const coreScripts = jsFiles.slice(0, 3);
            await Promise.all(coreScripts.map(url => {
                return new Promise(resolve => {
                    requestIdleCallback(() => loadScript(url).then(resolve));
                });
            }));
        } catch (error) {
            console.error('Erro ao carregar scripts:', error);
        }
    }

    // Inicia o carregamento assim que possível
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadScriptsSequentially);
    } else {
        loadScriptsSequentially();
    }
</script>
</body>
</html>