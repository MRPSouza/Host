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

<main>
    <!-- Cabeçalho da Página -->
    <section class="bg-gradient-success-dark py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 text-white fw-bold">Nossos Serviços</h1>
                    <p class="lead text-white">Conheça todos os serviços oferecidos pela MisterCel</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Lista Detalhada de Serviços -->
    <section class="py-5">
        <div class="container">
            <!-- Smartphones -->
            <div class="row mb-5">
                <div class="col-md-6">
                    <h2 class="mb-4"><i class="bi bi-phone text-success me-2"></i>Smartphones</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Troca de Tela</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Troca de Bateria</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Reparo em Placa</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Recuperação de Software</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Limpeza e Manutenção</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="bg-light p-4 rounded">
                        <h4 class="mb-3">Marcas Atendidas</h4>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-success">Samsung</span>
                            <span class="badge bg-success">Apple</span>
                            <span class="badge bg-success">Motorola</span>
                            <span class="badge bg-success">LG</span>
                            <span class="badge bg-success">Xiaomi</span>
                            <span class="badge bg-success">Asus</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tablets -->
            <div class="row mb-5">
                <div class="col-md-6">
                    <h2 class="mb-4"><i class="bi bi-tablet text-success me-2"></i>Tablets</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Substituição de Tela</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Troca de Bateria</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Reparo em Conectores</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Atualização de Sistema</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="bg-light p-4 rounded">
                        <h4 class="mb-3">Principais Marcas</h4>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-success">iPad</span>
                            <span class="badge bg-success">Samsung</span>
                            <span class="badge bg-success">Lenovo</span>
                            <span class="badge bg-success">Amazon</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Computadores -->
            <div class="row">
                <div class="col-md-6">
                    <h2 class="mb-4"><i class="bi bi-laptop text-success me-2"></i>Computadores</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Formatação</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Backup de Dados</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Limpeza</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Upgrade de Hardware</li>
                        <li class="mb-3"><i class="bi bi-check2-circle text-success me-2"></i>Remoção de Vírus</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="bg-light p-4 rounded">
                        <h4 class="mb-3">Serviços Especiais</h4>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="bi bi-gear text-success me-2"></i>Montagem de PCs</li>
                            <li class="mb-2"><i class="bi bi-gear text-success me-2"></i>Recuperação de HD/SSD</li>
                            <li><i class="bi bi-gear text-success me-2"></i>Instalação de Programas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>