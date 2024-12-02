// Executa antes do DOMContentLoaded
(function() {
    const isFirstLoad = performance.navigation.type === 1 || !sessionStorage.getItem('notFirstLoad');
    
    if (isFirstLoad) {
        document.write('<div id="preloader"><div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div></div>');
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        let preloader = document.getElementById('preloader');
        let loadTimer = null;
        
        const createLoader = () => {
            const loader = document.createElement('div');
            loader.id = 'preloader';
            loader.innerHTML = '<div class="loader"><div class="spinner"></div><div class="loading-text">Carregando...</div></div>';
            document.body.appendChild(loader);
            return loader;
        };
        
        if (!preloader) {
            preloader = createLoader();
        }
        
        window.hideLoader = function() {
            if (loadTimer) {
                clearTimeout(loadTimer);
                loadTimer = null;
            }
            
            const currentLoader = document.getElementById('preloader');
            if (currentLoader) {
                currentLoader.classList.add('loaded');
                currentLoader.style.display = 'none';
            }
        };
        
        window.showLoader = function(forceImmediate = false) {
            if (loadTimer) clearTimeout(loadTimer);
            
            if (!document.getElementById('preloader')) {
                preloader = createLoader();
            }
            
            preloader.classList.remove('loaded');
            preloader.style.display = 'flex';
            
            if (!forceImmediate) {
                loadTimer = setTimeout(hideLoader, 2000);
            }
        };
        
        // Tratamento igual para primeiro carregamento e carregamentos subsequentes
        if (isFirstLoad) {
            showLoader(true);
        }
        
        window.addEventListener('load', hideLoader);
        
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && 
                !link.target && 
                !e.ctrlKey && 
                !e.shiftKey && 
                !link.hasAttribute('download') && 
                link.href.indexOf('tel:') !== 0 && 
                link.href.indexOf('mailto:') !== 0) {
                
                const isFullPageLoad = !link.hasAttribute('data-ajax');
                showLoader(isFullPageLoad);
            }
        });
        
        window.addEventListener('popstate', hideLoader);
        
        // Marca que não é mais primeiro carregamento
        sessionStorage.setItem('notFirstLoad', 'true');
    });
})(); 