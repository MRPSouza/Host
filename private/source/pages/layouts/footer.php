<footer class="custom-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <!-- Logo e Descrição -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-info">
                        <img src="img/logo - Mister Cel 2.png" alt="Logo Mister Cel" class="footer-logo mb-4">
                        <p class="footer-description">
                            Especialistas em reparos de celulares, tablets e notebooks. 
                            Qualidade e confiança para cuidar do seu dispositivo.
                        </p>
                        <div class="social-links mt-4">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Links Rápidos -->
                <div class="col-lg-2 col-md-6">
                    <h4>Links Rápidos</h4>
                    <ul class="footer-links">
                        <li><a href="index">Home</a></li>
                        <li><a href="sobre">Sobre Nós</a></li>
                        <li><a href="servicos">Serviços</a></li>
                        <li><a href="contato">Contato</a></li>
                    </ul>
                </div>

                <!-- Políticas -->
                <div class="col-lg-2 col-md-6">
                    <h4>Políticas</h4>
                    <ul class="footer-links">
                        <li><a href="politica_de_privacidade.php">Privacidade</a></li>
                        <li><a href="politica_de_uso.php">Termos de Uso</a></li>
                        <li><a href="politica_de_cookies.php">Cookies</a></li>
                    </ul>
                </div>

                <!-- Contato -->
                <div class="col-lg-4 col-md-6">
                    <h4>Contato</h4>
                    <div class="footer-contact">
                        <p><i class="fas fa-map-marker-alt"></i> Rua Exemplo, 123 - Cidade</p>
                        <p><i class="fas fa-phone"></i> (11) 99999-9999</p>
                        <p><i class="fas fa-envelope"></i> contato@mistercel.com.br</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright">
                        &copy; <?php echo date('Y'); ?> Mister Cel. Todos os direitos reservados.
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.custom-footer {
    background: linear-gradient(180deg, rgba(39, 41, 40, 0.98) 0%, rgba(23, 25, 24, 1) 100%);
    color: rgba(255, 255, 255, 0.9);
    padding-top: 80px;
    position: relative;
}

.footer-top {
    padding-bottom: 40px;
}

.footer-logo {
    width: 200px;
    height: auto;
}

.footer-description {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 20px;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-icon {
    width: 38px;
    height: 38px;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: white;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background: #00a658;
    color: white;
    transform: translateY(-3px);
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
}

.footer-links a:hover {
    color: #00a658;
    padding-left: 5px;
}

h4 {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 10px;
}

h4::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 30px;
    height: 2px;
    background: #00a658;
}

.footer-contact p {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255, 255, 255, 0.7);
}

.footer-contact i {
    color: #00a658;
    width: 20px;
}

.footer-bottom {
    background: rgba(0, 0, 0, 0.2);
    padding: 20px 0;
    margin-top: 30px;
}

.copyright {
    text-align: center;
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.9rem;
}

/* Responsividade */
@media (max-width: 991px) {
    .footer-info {
        margin-bottom: 30px;
    }
    
    h4 {
        margin-top: 20px;
    }
}

@media (max-width: 768px) {
    .custom-footer {
        padding-top: 50px;
    }
    
    .footer-logo {
        width: 160px;
    }
}
</style>