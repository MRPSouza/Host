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

<div class="container py-5">
    <h1 class="mb-4">Entre em Contato</h1>
    
    <div class="row">
        <div class="col-md-6">
            <form id="contactForm" data-whatsapp="5511999999999">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" required>
                </div>
                
                <div class="mb-3">
                    <label for="sobrenome" class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome" required>
                </div>
                
                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea class="form-control" id="mensagem" rows="4" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fab fa-whatsapp me-2"></i>Enviar via WhatsApp
                </button>
            </form>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Outras formas de contato</h5>
                    <p class="card-text">
                        <i class="bi bi-shop me-2"></i>Visite nossa loja física<br>
                        <i class="bi bi-clock me-2"></i>Segunda a Sexta: 9h às 18h<br>
                        <i class="bi bi-geo-alt me-2"></i>Endereço da loja
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclua o script externo -->
<script src="/assets/js/contact.js"></script>
