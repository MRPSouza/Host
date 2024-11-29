<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php 
    // Verifica se existe uma instância de SEO e a utiliza
    if (isset($seo)) {
        echo $seo->render();
    } else {
        // SEO padrão caso não tenha sido configurado
        $defaultSeo = new SEO();
        $defaultSeo->setTitle('Meu Site')
                  ->setDescription('Descrição padrão do site')
                  ->setKeywords('site, web')
                  ->setImage(BASE_URL . '/assets/img/logo.png');
        echo $defaultSeo->render();
    }
    ?>
</head>
<body>
    <!-- Loader -->
    <div id="preloader">
        <div class="loader">
            <div class="spinner"></div>
            <div class="loading-text">Carregando...</div>
        </div>
    </div>

    <style>
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease-out;
    }

    .loader {
        text-align: center;
    }

    .spinner {
        width: 40px;
        height: 40px;
        margin: 0 auto;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .loading-text {
        margin-top: 10px;
        color: #666;
        font-family: Arial, sans-serif;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Classe para esconder o loader */
    .loaded {
        opacity: 0;
        visibility: hidden;
    }
    </style>

    <script>
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        preloader.classList.add('loaded');
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500);
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Função para carregar conteúdo via AJAX
        function loadContent(href) {
            toggleLoader(true);
            
            console.log('Iniciando requisição AJAX para:', href);
            
            fetch(href, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(response => {
                console.log('Resposta recebida:', response);
                return response.text();
            })
            .then(html => {
                console.log('Conteúdo recebido:', html.substring(0, 100) + '...'); // Mostra os primeiros 100 caracteres
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const mainContent = doc.querySelector('main');
                
                if (mainContent) {
                    document.querySelector('main').innerHTML = mainContent.innerHTML;
                    console.log('Conteúdo principal atualizado');
                } else {
                    console.error('Elemento main não encontrado na resposta');
                }
                
                window.history.pushState({}, '', href);
            })
            .catch(error => {
                console.error('Erro ao carregar página:', error);
            })
            .finally(() => {
                toggleLoader(false);
            });
        }

        // Intercepta todos os cliques em links do menu
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                loadContent(href);
            });
        });

        // Gerencia o botão voltar do navegador
        window.addEventListener('popstate', function(e) {
            loadContent(window.location.href);
        });
    });
    </script>
</body>
</html>