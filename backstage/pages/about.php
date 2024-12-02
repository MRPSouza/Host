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
                    <h1 class="display-4 text-white fw-bold">Sobre a MisterCel</h1>
                    <p class="lead text-white">Conheça nossa história e compromisso com a qualidade</p>
                </div>
            </div>
        </div>
    </section>

    <!-- História e Missão -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="mb-4">Nossa História</h2>
                    <p class="lead">Desde 2008 atendendo Maringá e região com excelência</p>
                    <p>A MisterCel nasceu da paixão por tecnologia e do desejo de oferecer serviços de qualidade em reparos de dispositivos eletrônicos. Começamos como uma pequena assistência técnica e hoje somos referência na região.</p>
                    <p>Nossa jornada é marcada por constante evolução e aprendizado, sempre nos mantendo atualizados com as últimas tecnologias do mercado.</p>
                </div>
                <div class="col-lg-6">
                    <div class="bg-light p-4 rounded">
                        <h3 class="mb-4">Números que nos Orgulham</h3>
                        <div class="row text-center">
                            <div class="col-6 mb-4">
                                <h4 class="text-success">15+</h4>
                                <p class="mb-0">Anos de Experiência</p>
                            </div>
                            <div class="col-6 mb-4">
                                <h4 class="text-success">10k+</h4>
                                <p class="mb-0">Clientes Atendidos</p>
                            </div>
                            <div class="col-6">
                                <h4 class="text-success">98%</h4>
                                <p class="mb-0">Satisfação</p>
                            </div>
                            <div class="col-6">
                                <h4 class="text-success">5k+</h4>
                                <p class="mb-0">Reparos Realizados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Missão, Visão e Valores -->
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-target text-success fs-1 mb-3"></i>
                            <h3>Missão</h3>
                            <p>Oferecer soluções em reparos técnicos com excelência, garantindo a satisfação total dos nossos clientes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-eye text-success fs-1 mb-3"></i>
                            <h3>Visão</h3>
                            <p>Ser reconhecida como a melhor assistência técnica de Maringá, referência em qualidade e atendimento.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-heart text-success fs-1 mb-3"></i>
                            <h3>Valores</h3>
                            <ul class="list-unstyled text-start">
                                <li><i class="bi bi-check2 text-success me-2"></i>Ética</li>
                                <li><i class="bi bi-check2 text-success me-2"></i>Transparência</li>
                                <li><i class="bi bi-check2 text-success me-2"></i>Compromisso</li>
                                <li><i class="bi bi-check2 text-success me-2"></i>Qualidade</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>