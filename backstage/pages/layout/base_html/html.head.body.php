<?php
// Adicione isto no início absoluto do seu arquivo PHP principal, antes de qualquer HTML ou whitespace
header("Access-Control-Allow-Origin: https://www.matheusrpsouza.com");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if (
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' || 
    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
) {
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
}
header("Content-Security-Policy: default-src 'none'; script-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://code.jquery.com 'sha256-3NoEtkEHDA8z02jxlEUdUqAZ34d7pY2rg3AaP2FDXDE=' 'sha256-XMv3CM8yat1em/x2bEYTzNrHS7kE+AaP2FDXDE=' 'sha256-j9dNgTHVcc48L1ySZTrEoVzwnycrTXRNN5y/GxtJojk='; style-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.googleapis.com 'sha256-PtwgLPalWNZocrAtmYoZ0a6TWdZzg3zemiUcVGvoOA0=' 'sha256-z0WHBt+2WMiOK2g8o/EZRVoYAqxoS3GYwEa9/2CQ35o=' 'sha256-18GSEs+HivkI2LITdReDU50cTBVwChtq6+/L4kerp5Q='; font-src 'self' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://fonts.gstatic.com data:; img-src 'self' data: https:; media-src 'self' data: https://*; connect-src 'self' *; frame-ancestors 'none'; form-action 'self'; base-uri 'self'; manifest-src 'self'; upgrade-insecure-requests; block-all-mixed-content");
?>

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
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/assets/img/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_URL; ?>/assets/img/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_URL; ?>/assets/img/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_URL; ?>/assets/img/favicon.png">
    <link rel="manifest" href="<?php echo BASE_URL; ?>/site.webmanifest">
    
    <!-- Previne requisições automáticas de favicon -->
    <link rel="icon" href="data:,">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            justify-content: start;
            align-items: left;
        }

        main {
            flex: 1 0 auto;
            display: flex;
            justify-content: start;
            align-items: left;
            width: 100%;
        }

        footer {
            margin-top: auto;
            padding: 1rem;
            background-color: #f8f9fa;
            text-align: center;
            width: 100%;
        }
    </style>
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
        // Função para mostrar/esconder o loader
        function toggleLoader(show = true) {
            const preloader = document.getElementById('preloader');
            if (show) {
                preloader.style.display = 'flex';
                preloader.classList.remove('loaded');
            } else {
                preloader.classList.add('loaded');
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            }
        }

        // Função para carregar conteúdo via AJAX
        function loadContent(href) {
            toggleLoader(true);
            
            fetch(href, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const mainContent = doc.querySelector('main');
                
                if (mainContent) {
                    document.querySelector('main').innerHTML = mainContent.innerHTML;
                    window.history.pushState({}, '', href);
                } else {
                    throw new Error('Elemento main não encontrado na resposta');
                }

                const seoData = doc.querySelector('seo-data');
                if (seoData) {
                    const head = document.querySelector('head');
                    // Remove as meta tags antigas de SEO
                    head.querySelectorAll('meta[name="description"], meta[name="keywords"], title, meta[property^="og:"]').forEach(el => el.remove());
                    
                    // Adiciona apenas as novas meta tags de SEO
                    const seoContent = seoData.innerHTML;
                    head.insertAdjacentHTML('afterbegin', seoContent);
                }
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