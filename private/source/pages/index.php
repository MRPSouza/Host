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
                    <h1 class="display-4 fw-bold text-gradient mb-3" id="texto-animado"></h1>
                    <p class="lead text-light-gray mb-4">Confira os reparos mais solicitados para nossos técnicos especializados</p>
                    <button class="custom-button" type="button">
                        <span class="button-content">
                            <i class="fab fa-whatsapp me-2"></i>
                            Solicitar Orçamento
                        </span>
                    </button>
                </div>
            </div>    
        </div>
        
        <div class="services-grid">
            <!-- Tela Quebrada -->
            <div class="service-item tela-quebrada">
                <div class="service-content">
                    <h3>Tela Quebrada</h3>
                    <p>Seu celular caiu e danificou a tela? Nós vamos até você e realizamos a troca rapidamente.</p>
                    <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Não Liga -->
            <div class="service-item nao-liga">
                <div class="service-content">
                    <h3>Não Liga</h3>
                    <p>Seu celular caiu, parou de carregar ou não liga mais? Nós diagnosticamos o problema e fazemos o reparo.</p>
                    <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Bateria -->
            <div class="service-item bateria">
                <div class="service-content">
                    <h3>Bateria Não Dura</h3>
                    <p>Você mal termina de carregar já está com pouca bateria? Nós realizamos a troca em poucos minutos!</p>
                    <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Molhou -->
            <div class="service-item molhou">
                <div class="service-content">
                    <h3>Celular Molhou</h3>
                    <p>Seu celular decidiu dar um pulo na piscina? Solicite um técnico o mais rápido possível!</p>
                    <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Conector/Carregador -->
            <div class="service-item conector">
                <div class="service-content">
                    <h3>Conector Danificado</h3>
                    <p>Problemas para carregar? Seu conector pode estar danificado. Fazemos a troca com garantia!</p>
                    <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Botões -->
            <div class="service-item botoes">
                <div class="service-content">
                    <h3>Botões com Defeito</h3>
                    <p>Botões travados ou não funcionando? Realizamos o reparo no mesmo dia!</p>
                    <a href="#" class="service-link">Saiba mais <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="custom-shape-divider-bottom-1731527513">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M892.25 114.72L0 0 0 120 1200 120 1200 0 892.25 114.72z" class="shape-fill"></path>
        </svg>
    </div>

    <!-- Modifique o script para: -->
    <script>
    (function() {
        setTimeout(function() {
            const textos = [
                "Bem-vindo à MisterCel!",
                "Aqui seu celular tem solução.",
                "Consertos rápidos e de qualidade.",
                "Reparamos smartphones e tablets.",
                "Peças originais ou paralelas com garantia.",
                "Técnicos experientes e certificados.",
                "Orçamento grátis e sem compromisso.",
                "Consertamos todas as marcas.",
                "Experiência e confiança.",
                "Reparos rápidos e eficazes.",
                "Garantia em todos os serviços.",
                "Seu celular pronto rapidamente.",
                "Faça um orçamento com a MisterCel!"
            ];




            let textoAtual = 0;
            let letraAtual = 0;
            let esperaAntesDeApagar = 4000;
            let esperaAntesDeEscrever = 200;
            const velocidadeDigitacao = 50;
            const velocidadeApagar = 25;
            let animacaoEmAndamento = false;

            const elementoTexto = document.getElementById('texto-animado');
            
            if (elementoTexto && !animacaoEmAndamento) {
                animacaoEmAndamento = true;

                function escrever() {
                    if (!elementoTexto) return;
                    
                    if (letraAtual < textos[textoAtual].length) {
                        elementoTexto.textContent += textos[textoAtual].charAt(letraAtual);
                        letraAtual++;
                        requestAnimationFrame(() => setTimeout(escrever, velocidadeDigitacao));
                    } else {
                        setTimeout(apagar, esperaAntesDeApagar);
                    }
                }

                function apagar() {
                    if (!elementoTexto) return;
                    
                    if (letraAtual > 0) {
                        elementoTexto.textContent = textos[textoAtual].substring(0, letraAtual - 1) || "\u00A0";
                        letraAtual--;
                        requestAnimationFrame(() => setTimeout(apagar, velocidadeApagar));
                    } else {
                        textoAtual = (textoAtual + 1) % textos.length;
                        setTimeout(escrever, esperaAntesDeEscrever);
                    }
                }

                setTimeout(escrever, 100);
            }
        }, 500);
    })();
    </script>
</section>

<style>
.services-section {
    padding: 5rem 0;
    background-color: #1a1a1a;
    position: relative;
    color: #fff;
    overflow: hidden;
}

.services-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAIAAACRXR/mAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAABnSURBVHja7M5RDYAwDEXRDgmvEocnlrQS2SwUFST9uEfBGWs9c97nbGtDcquqiKhOImLs/UpuzVzWEi1atGjRokWLFi1atGjRokWLFi1atGjRokWLFi1af7Ukz8xWp8z8AAAA//8DAJ4LoEAAlL1nAAAAAElFTkSuQmCC") repeat 0 0;
    opacity: 0.17;
    animation: bg-scrolling-reverse 3.12s infinite linear;
    z-index: 1;
}

.services-section::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: linear-gradient(
        rgba(0, 37, 20, 0.90),
        rgba(0, 37, 20, 0.90)
    ), url('img/Conserto-de-celular.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    z-index: 0;
}

@keyframes bg-scrolling-reverse {
    100% { background-position: 0 50px; }
}

/* Ajuste para garantir que o conteúdo fique visível */
.services-section > * {
    position: relative;
    z-index: 2;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    padding: 0 2rem;
    max-width: 1140px;
    margin: 0 auto;
}

.service-item {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 16px;
    padding: 2rem;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.1);
    position: relative;
    overflow: hidden;
}

.service-item:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.08);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.service-icon {
    font-size: 2.5rem;
    color: #fefefe;
    margin-bottom: 1.5rem;
    background: rgba(255, 255, 255, 0.1);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.service-content h3 {
    color: #fefefe;
    font-size: 1.5rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.service-content p {
    color: #e0e0e0;
    margin-bottom: 1.2rem;
    line-height: 1.6;
}

.service-link {
    color: #fefefe;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.service-link:hover {
    color: rgba(255, 255, 255, 0.8);
    gap: 0.8rem;
}

@media (max-width: 768px) {
    .services-grid {
        grid-template-columns: 1fr;
        padding: 0 1rem;
    }
    
    .service-item {
        padding: 1.5rem;
    }
}

.circles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
}

.circles li {
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.05);
    animation: animate 25s linear infinite;
    bottom: -150px;
}

.circles li:nth-child(1){
    left: 25%;
    width: 80px;
    height: 80px;
    animation-delay: 0s;
}

.circles li:nth-child(2){
    left: 10%;
    width: 20px;
    height: 20px;
    animation-delay: 2s;
    animation-duration: 12s;
}

.circles li:nth-child(3){
    left: 70%;
    width: 20px;
    height: 20px;
    animation-delay: 4s;
}

.circles li:nth-child(4){
    left: 40%;
    width: 60px;
    height: 60px;
    animation-delay: 0s;
    animation-duration: 18s;
}

.circles li:nth-child(5){
    left: 65%;
    width: 20px;
    height: 20px;
    animation-delay: 0s;
}

.circles li:nth-child(6){
    left: 75%;
    width: 110px;
    height: 110px;
    animation-delay: 3s;
}

.circles li:nth-child(7){
    left: 35%;
    width: 150px;
    height: 150px;
    animation-delay: 7s;
}

.circles li:nth-child(8){
    left: 50%;
    width: 25px;
    height: 25px;
    animation-delay: 15s;
    animation-duration: 45s;
}

.circles li:nth-child(9){
    left: 20%;
    width: 15px;
    height: 15px;
    animation-delay: 2s;
    animation-duration: 35s;
}

.circles li:nth-child(10){
    left: 85%;
    width: 150px;
    height: 150px;
    animation-delay: 0s;
    animation-duration: 11s;
}

@keyframes animate {
    0% {
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }
    100% {
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }
}
</style>



<style>
.custom-shape-divider-bottom-1731527513 {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    z-index: 2;
}

.custom-shape-divider-bottom-1731527513 svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 70px;
}

.custom-shape-divider-bottom-1731527513 .shape-fill {
    fill: #FFFFFF;
}

/* Ajustes responsivos */
@media (max-width: 767px) {
    .custom-shape-divider-bottom-1731527513 svg {
        height: 40px;
    }
}

@media (min-width: 768px) and (max-width: 1024px) {
    .custom-shape-divider-bottom-1731527513 svg {
        height: 55px;
    }
}
</style>

<style>
/* Adicione estes estilos */
.text-gradient {
    background: linear-gradient(45deg, #fff, #7fffd4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.text-light-gray {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.2rem;
}

.custom-button {
    padding: 15px 35px;
    border: none;
    border-radius: 50px;
    background: linear-gradient(45deg, #209978, #17795E);
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(32, 153, 120, 0.3);
}

.custom-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(32, 153, 120, 0.5);
}

.custom-button:active {
    transform: translateY(1px);
}

.button-content {
    display: flex;
    align-items: center;
    justify-content: center;
}

@media (max-width: 768px) {
    .display-4 {
        font-size: 2.5rem;
    }
    
    .lead {
        font-size: 1rem;
    }
    
    .custom-button {
        padding: 12px 30px;
        font-size: 1rem;
    }
}
</style>

<style>
.typing-effect {
    border-right: 3px solid #7fffd4;
    animation: blink 0.75s step-end infinite;
}

@keyframes blink {
    from, to { border-color: transparent }
    50% { border-color: #7fffd4 }
}
</style>

<style>
.service-item::after {
    content: "";
    position: absolute;
    bottom: -20px;
    right: -20px;
    width: 140px;
    height: 140px;
    background-color: rgba(255, 255, 255, 0.03);
    mask-image: var(--icon);
    -webkit-mask-image: var(--icon);
    mask-size: contain;
    -webkit-mask-size: contain;
    mask-repeat: no-repeat;
    -webkit-mask-repeat: no-repeat;
    z-index: 0;
    transition: all 0.3s ease;
}

.service-content {
    position: relative;
    z-index: 1;
}

.service-item.tela-quebrada::after {
    --icon: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M16 64C16 28.7 44.7 0 80 0H304c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H80c-35.3 0-64-28.7-64-64V64zM224 448a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM304 64H80V384H304V64z"/></svg>');
}

.service-item.nao-liga::after {
    --icon: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M400 54.1c63 45 104 118.6 104 201.9 0 136.8-110.8 247.7-247.5 248C120 504.3 8.2 393 8 256.4 7.9 173.1 48.9 99.3 111.8 54.2c11.7-8.3 28-4.8 35 7.7L162.6 90c5.9 10.5 3.1 23.8-6.6 31-41.5 30.8-68 79.6-68 134.9-.1 92.3 74.5 168.1 168 168.1 91.6 0 168.6-74.2 168-169.1-.3-51.8-24.7-101.8-68.1-134-9.7-7.2-12.4-20.5-6.5-31l15.8-28.1c7-12.4 23.2-16.1 34.8-7.8zM296 264V24c0-13.3-10.7-24-24-24h-32c-13.3 0-24 10.7-24 24v240c0 13.3 10.7 24 24 24h32c13.3 0 24-10.7 24-24z"/></svg>');
}

.service-item.bateria::after {
    --icon: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M464 160c8.8 0 16 7.2 16 16V336c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16H464zM80 96C35.8 96 0 131.8 0 176V336c0 44.2 35.8 80 80 80H464c44.2 0 80-35.8 80-80V320c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32V176c0-44.2-35.8-80-80-80H80zm208 96H96V320H288V192z"/></svg>');
}

.service-item.molhou::after {
    --icon: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M192 512C86 512 0 426 0 320C0 228.8 130.2 57.7 166.6 11.7C172.6 4.2 181.5 0 191.1 0h1.8c9.6 0 18.5 4.2 24.5 11.7C253.8 57.7 384 228.8 384 320c0 106-86 192-192 192zM96 336c0-8.8-7.2-16-16-16s-16 7.2-16 16c0 61.9 50.1 112 112 112c8.8 0 16-7.2 16-16s-7.2-16-16-16c-44.2 0-80-35.8-80-80z"/></svg>');
}

.service-item.conector::after {
    --icon: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M128 0C110.3 0 96 14.3 96 32v96H80c-44.2 0-80 35.8-80 80V432c0 44.2 35.8 80 80 80h224c44.2 0 80-35.8 80-80V208c0-44.2-35.8-80-80-80h-16V32c0-17.7-14.3-32-32-32s-32 14.3-32 32v96H160V32c0-17.7-14.3-32-32-32zM48 208c0-17.7 14.3-32 32-32h224c17.7 0 32 14.3 32 32V432c0 17.7-14.3 32-32 32H80c-17.7 0-32-14.3-32-32V208z"/></svg>');
}

.service-item.botoes::after {
    --icon: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM256 304c13.25 0 24-10.75 24-24v-128C280 138.8 269.3 128 256 128S232 138.8 232 152v128C232 293.3 242.8 304 256 304zM256 337.1c-17.36 0-31.44 14.08-31.44 31.44C224.6 385.9 238.6 400 256 400s31.44-14.08 31.44-31.44C287.4 351.2 273.4 337.1 256 337.1z"/></svg>');
}

</style>
