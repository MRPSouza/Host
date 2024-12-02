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
<footer class="bg-success text-white py-4 mt-auto">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <img src="<?= BASE_URL ?>/assets/img/logo-mister-cel.png" alt="Mister Cel" height="40" class="mb-3">
                <p class="mb-0">Sua parceira sempre disponível <br>para pronto atendimento desde 2008</p>
            </div>
            <div class="col-md-4">
                <h5 class="mb-3">Contato</h5>
                <p><i class="bi bi-geo-alt-fill me-2"></i>Av. Pedro Taques, 2225</p>
                <p><i class="bi bi-building me-2"></i>Jd Alvorada - Maringá PR</p>
                <p><i class="bi bi-telephone-fill me-2"></i>(XX) XXXX-XXXX</p>
                <p><i class="bi bi-clock-fill me-2"></i>Segunda a Sexta: 9h às 18h</p>
            </div>
            <div class="col-md-4">
                <h5 class="mb-3">Links Rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="<?= BASE_URL ?>/services" class="text-white text-decoration-none"><i class="bi bi-chevron-right me-2"></i>Serviços</a></li>
                    <li><a href="<?= BASE_URL ?>/about" class="text-white text-decoration-none"><i class="bi bi-chevron-right me-2"></i>Sobre Nós</a></li>
                    <li><a href="<?= BASE_URL ?>/contact" class="text-white text-decoration-none"><i class="bi bi-chevron-right me-2"></i>Contato</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">&copy; <?= date('Y') ?> Mister Cel. Todos os direitos reservados.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="text-white text-decoration-none me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white text-decoration-none me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white text-decoration-none me-3"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>
    </div>
</footer>