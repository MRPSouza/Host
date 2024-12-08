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
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= BASE_URL ?>/">
                <img src="<?= BASE_URL ?>/assets/img/logo-mister-cel.png" alt="Mister Cel" height="50" class="mb-3">
                <span class="badge bg-light text-success rounded-pill align-self-end">Desde 2008</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/"><i class="bi bi-house-door me-1"></i>Início</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="<?= BASE_URL ?>/services" id="servicesDropdown">
                            <i class="bi bi-tools me-1"></i>Serviços
                        </a>
                        <ul class="dropdown-menu dropdown-menu-hover" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>/services/phones">Celulares</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>/services/tablets">Tablets</a></li>
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>/services/notebooks">Notebooks</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/about"><i class="bi bi-info-circle me-1"></i>Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/contact"><i class="bi bi-envelope me-1"></i>Contato</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-light text-success" href="tel:+5511999999999">
                            <i class="bi bi-whatsapp me-1"></i>Agende Agora
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="navbar-spacer"></div>
</header>