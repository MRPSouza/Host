<?php
/**
 * LEMBRETES IMPORTANTES:
 * 
 * 1. ESTRUTURA BASE HTML:
 * - html.head.body.php e html.script.body.php são carregados automaticamente em todas as páginas
 * - Não é necessário criar tags <html>, <head>, <body> ou incluir scripts nas páginas individuais
 * - CSS e JS complementares devem ser adicionados separadamente em arquivos .css e .js
 * 
 * 2. COMPONENTES BOOTSTRAP DISPONÍVEIS:
 * - Bootstrap 5.3.0 (CSS e JS)
 * - Bootstrap Icons
 * - Bootstrap Popover-X
 * - Bootstrap Tooltip-X
 * - Bootstrap Toastify
 * - Bootstrap Select
 * - Bootstrap Table
 * - Bootstrap Toggle
 * - Bootstrap TouchSpin
 * - Bootstrap TagsInput
 * - Bootstrap DateRangePicker
 * - Bootstrap DateTimePicker
 * - Bootstrap ColorPicker
 * - Bootstrap MaxLength
 * - Bootstrap Input Spinner
 * 
 * Todos os componentes acima já estão configurados e prontos para uso.
 */

// Ativa exibição de erros para debug em desenvolvimento
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