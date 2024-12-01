<?php
/**
 * LEMBRETES IMPORTANTES:
 * 
 * Framework CSS/JS:
 * - Bootstrap 5.3.3 (CSS e JS)
 *   • Popover
 *   • Tooltip
 *   • Modal
 *   • Dropdown
 *   • E outros componentes do Bootstrap
 * - Font Awesome 6.5.1
 * - Bootstrap Icons 1.11.3
 * 
 * Bibliotecas JavaScript:
 * - jQuery 3.7.1
 * 
 * Todos os componentes estão configurados com:
 * - Fallback automático para CDN alternativo
 * - Fallback para arquivos locais em /assets/vendor/
 * - Carregamento otimizado (crítico vs não-crítico)
 * - Política de segurança CSP configurada
 * 
 * OBSERVAÇÃO:
 * - Não é necessário incluir tags <html>, <head>, <body> ou scripts
 * - Arquivos html.head.body.php e html.script.body.php são carregados automaticamente
 * - CSS e JS adicionais devem ser incluídos em arquivos separados
 */

?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>/">
                <img src="<?= BASE_URL ?>/assets/img/logo.png" alt="Logo" height="40" class="d-inline-block align-text-top">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/services">Serviços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/about">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/contact">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>