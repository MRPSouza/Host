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
<footer class="bg-dark text-light py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="mb-4"><i class="fas fa-mobile-alt text-primary me-2"></i>Mister Cel</h5>
                <p class="">Sua assistência técnica especializada em dispositivos móveis e notebooks desde 2008. Oferecemos soluções profissionais com garantia e qualidade.</p>
                <div class="mt-4">
                    <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4">
                <h5 class="mb-4">Horário de Funcionamento</h5>
                <ul class="list-unstyled ">
                    <li class="mb-2"><i class="bi bi-clock me-2"></i>Segunda à Sexta: 09h às 18h</li>
                    <li class="mb-2"><i class="bi bi-clock me-2"></i>Sábado: 09h às 13h</li>
                    <li class="mb-2"><i class="bi bi-clock-fill me-2"></i>Domingo: Fechado</li>
                </ul>
            </div>
            
            <div class="col-lg-4">
                <h5 class="mb-4">Contato</h5>
                <ul class="list-unstyled ">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt me-2"></i>
                        Rua Example, 123 - São Paulo, SP
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone me-2"></i>
                        <a href="tel:+5511999999999" class=" text-decoration-none">
                            (11) 99999-9999
                        </a>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope me-2"></i>
                        <a href="mailto:contato@mistercel.com.br" class=" text-decoration-none">
                            contato@mistercel.com.br
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0 ">&copy; <?= date('Y') ?> Mister Cel. Todos os direitos reservados.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="<?= BASE_URL ?>/privacy" class=" text-decoration-none me-3">Política de Privacidade</a>
                <a href="<?= BASE_URL ?>/terms" class=" text-decoration-none">Termos de Uso</a>
            </div>
        </div>
    </div>
</footer>