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

<main class="desktop-container">
    <!-- Área de Trabalho -->
    <div class="desktop" id="desktop">
        <!-- Ícones da Área de Trabalho -->
        <div class="desktop-icon" draggable="true" data-path="/services">
            <i class="bi bi-tools"></i>
            <span>Serviços</span>
        </div>
        
        <div class="desktop-icon" draggable="true" data-path="/about">
            <i class="bi bi-info-circle"></i>
            <span>Sobre Nós</span>
        </div>
        
        <div class="desktop-icon" draggable="true" data-path="/contact">
            <i class="bi bi-telephone"></i>
            <span>Contato</span>
        </div>

        <div class="desktop-icon" draggable="true" data-path="https://wa.me/seu-numero">
            <i class="bi bi-whatsapp"></i>
            <span>WhatsApp</span>
        </div>
    </div>

    <!-- Barra de Tarefas -->
    <div class="taskbar">
        <div class="start-button">
            <i class="bi bi-phone"></i>
            MisterCel
        </div>
        <div class="taskbar-time" id="taskbar-time"></div>
    </div>
</main>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/desktop.css">
<script src="<?= BASE_URL ?>/assets/js/desktop.js"></script>

