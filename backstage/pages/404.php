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