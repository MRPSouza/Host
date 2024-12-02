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

<section class="container-fluid services-section">
    <div class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </div>
    
    <div class="row m-0">
        <div class="col-12 text-center mb-5">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-8 mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold text-gradient mb-3" id="texto-animado">
                        Bem-vindo à MisterCel!
                    </h1>
                    <p class="lead text-light-gray mb-4">Confira os reparos mais solicitados para nossos técnicos especializados</p>
                    <button class="custom-button" type="button">
                        <span class="button-content">
                            <i class="fab fa-whatsapp me-2"></i>
                            Solicitar Orçamento!
                        </span>
                    </button>
                </div>
            </div>      
        </div>
    </div>
</section>


<!-- Hero Section -->
<section class="hero-section bg-gradient-success-dark py-5">
    <div class="custom-shape-divider-top-1733163571">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M600,112.77C268.63,112.77,0,65.52,0,7.23V120H1200V7.23C1200,65.52,931.37,112.77,600,112.77Z" class="shape-fill"></path>
        </svg>
    </div>
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
            
            <!-- Novo card para Tablets -->
            <div class="col-md-4">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <div class="icon-wrapper">
                            <i class="bi bi-tablet"></i>
                        </div>
                        <h3 class="card-title">Tablets</h3>
                        <p class="card-text">Reparo e manutenção de tablets de todas as marcas</p>
                    </div>
                </div>
            </div>
            
            <!-- Novo card para Computadores -->
            <div class="col-md-4">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <div class="icon-wrapper">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h3 class="card-title">Computadores</h3>
                        <p class="card-text">Manutenção de notebooks e computadores desktop</p>
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
            
            <!-- Novo card para Acessórios -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-headphones fs-1 text-success mb-3"></i>
                        <h3>Acessórios</h3>
                        <p>Carregadores, fones de ouvido e outros acessórios originais</p>
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
                <div class="contact-info">
                    <p><i class="bi bi-geo-alt-fill text-success me-2"></i>Av. Pedro Taques, 2225 - Jd Alvorada - Maringá PR</p>
                    <p><i class="bi bi-clock-fill text-success me-2"></i>Segunda a Sexta: 9h às 18h</p>
                    <p><i class="bi bi-telephone-fill text-success me-2"></i>Telefone: (XX) XXXX-XXXX</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="map-container text-center">
                    <a href="https://maps.google.com/?q=Av.+Pedro+Taques,+2225+-+Jd+Alvorada+-+Maringá+PR" 
                       class="btn btn-success btn-lg"
                       target="_blank"
                       rel="noopener">
                        <i class="bi bi-map me-2"></i>Ver no Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

