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

<div class="container my-auto">
    <div class="text-center">
        <h1 class="display-1 fw-bold">404</h1>
        <div class="mb-4 lead">
            Oops! Página não encontrada
        </div>
        
        <div class="alert alert-warning mb-4">
            <p class="mb-0">
                O endereço <code><?php echo BASE_URL; ?>/<strong><?php echo htmlspecialchars($url); ?></strong></code> não foi localizado.
            </p>
            <p class="small mb-0 mt-2">
                Esta página pode ter sido removida, excluída ou nunca ter existido.
            </p>
        </div>

        <div class="mb-4">
            <p>Que tal tentar uma dessas opções?</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="<?php echo BASE_URL; ?>" class="btn btn-primary">
                    <i class="bi bi-house-door"></i> Página Inicial
                </a>
                <a href="<?php echo BASE_URL; ?>/contact" class="btn btn-outline-primary">
                    <i class="bi bi-envelope"></i> Contato
                </a>
            </div>
        </div>

        <div class="mt-5">
            <p class="text-muted small">
                Se você acredita que isso é um erro, por favor 
                <a href="<?php echo BASE_URL; ?>/contact">entre em contato</a> 
                com nossa equipe.
            </p>
        </div>
    </div>
</div>