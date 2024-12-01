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

<!-- Hero Section -->
<section class="hero-section bg-gradient-success-dark py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 text-white fw-bold">MisterCel</h1>
                <p class="lead text-white">Sua parceira disponível para pronto atendimento desde 2008</p>
                <p class="text-white mb-4">Assistência técnica especializada em smartphones, tablets e computadores</p>
                <a href="#servicos" class="btn btn-light btn-lg">Nossos Serviços</a>
            </div>
            <div class="col-lg-6">
                <!-- Removida a imagem temporariamente até ter as fotos reais -->
                <div class="bg-light p-4 rounded shadow text-center">
                    <i class="bi bi-building fs-1 text-success"></i>
                    <p class="mt-2">Imagem da loja em breve</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Serviços Principais -->
<section id="servicos" class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Nossos Serviços</h2>
        <div class="row g-4">
            <!-- Card de Smartphones -->
            <div class="col-md-4">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <div class="icon-wrapper">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h3 class="card-title">Smartphones</h3>
                        <p class="card-text">Assistência técnica especializada em Android e iPhone</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Por que escolher -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Por que escolher a MisterCel?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="bi bi-clock-history fs-1 text-success mb-3"></i>
                    <h3>15 Anos de Experiência</h3>
                    <p>Atendendo Maringá desde 2008 com qualidade e confiança</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="bi bi-shield-check fs-1 text-success mb-3"></i>
                    <h3>Garantia em Serviços</h3>
                    <p>Todos os serviços com garantia legal</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="bi bi-tools fs-1 text-success mb-3"></i>
                    <h3>Peças de Qualidade</h3>
                    <p>Trabalhamos com peças originais e alternativas de qualidade</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Produtos -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Produtos</h2>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-phone-fill fs-1 text-success mb-3"></i>
                        <h3>Capas e Películas</h3>
                        <p>Proteção completa para seu smartphone com instalação profissional</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Localização -->
<section class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Onde Estamos</h2>
        <div class="row">
            <div class="col-md-6">
                <p><i class="bi bi-geo-alt-fill text-success me-2"></i>Av. Pedro Taques, 2225 - Jd Alvorada - Maringá PR</p>
                <!-- Adicionar mais informações de contato -->
            </div>
            <div class="col-md-6">
                <!-- Placeholder para mapa do Google -->
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.google.com/maps/embed?..." allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

