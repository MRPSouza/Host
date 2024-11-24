<nav class="navbar navbar-expand-lg fixed-top custom-navbar">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="index" data-page="index">
            <img src="img/logo - Mister Cel 2.png" alt="Logo Mister Cel" class="brand-logo">
        </a>

        <!-- Botão hamburguer -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Menu de navegação -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index" data-page="index">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Políticas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="politica_de_uso.php">Termos de Uso</a></li>
                        <li><a class="dropdown-item" href="politica_de_privacidade.php">Privacidade</a></li>
                        <li><a class="dropdown-item" href="politica_de_cookies.php">Cookies</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link cadastro-btn" href="cadastro.php" data-page="cadastro">Cadastre-se</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
.custom-navbar {
    background: rgba(39, 41, 40, 0.98);
    backdrop-filter: blur(10px);
    padding: 15px 0;
    transition: all 0.3s ease;
}

.navbar-brand {
    padding: 0;
}

.brand-logo {
    width: 180px;
    height: auto;
    transition: all 0.3s ease;
}

.navbar-nav {
    gap: 10px;
}

.nav-link {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 500;
    padding: 8px 16px !important;
    transition: all 0.3s ease;
    position: relative;
}

.nav-link:hover {
    color: #00a658 !important;
}

.nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 50%;
    background-color: #00a658;
    transition: all 0.3s ease;
}

.nav-link:hover::after {
    width: 80%;
    left: 10%;
}

.cadastro-btn {
    background: linear-gradient(45deg, #00a658, #008548);
    border-radius: 50px;
    padding: 8px 24px !important;
    color: white !important;
    box-shadow: 0 4px 15px rgba(0, 166, 88, 0.2);
}

.cadastro-btn:hover {
    transform: translateY(-2px);
    color: white !important;
    box-shadow: 0 6px 20px rgba(0, 166, 88, 0.3);
}

.cadastro-btn::after {
    display: none;
}

.dropdown-menu {
    background: rgba(39, 41, 40, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 8px;
}

.dropdown-item {
    color: rgba(255, 255, 255, 0.9);
    padding: 8px 16px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background: rgba(0, 166, 88, 0.2);
    color: #00a658;
}

/* Navbar menor ao rolar */
.navbar.scrolled {
    padding: 10px 0;
    background: rgba(39, 41, 40, 0.98);
}

.navbar.scrolled .brand-logo {
    width: 160px;
}

/* Responsividade */
@media (max-width: 991px) {
    .navbar-collapse {
        background: rgba(39, 41, 40, 0.98);
        padding: 20px;
        border-radius: 8px;
        margin-top: 10px;
    }
    
    .nav-link::after {
        display: none;
    }
    
    .cadastro-btn {
        display: inline-block;
        text-align: center;
        margin-top: 10px;
    }
}

@media (max-width: 576px) {
    .brand-logo {
        width: 150px;
    }
}

/* Ajuste do botão hamburguer */
.navbar-toggler {
    border-color: rgba(255, 255, 255, 0.7);
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

/* Ajuste da altura no mobile */
@media (max-width: 991px) {
    .custom-navbar {
        padding: 16px 0; /* Aumentado de 15px para 16px */
    }

    .navbar.scrolled {
        padding: 12px 0; /* Aumentado de 10px para 12px */
    }
    
    /* ... outros estilos mobile existentes ... */
}

/* ... outros estilos existentes ... */
</style>

<script>
// Adicionar classe ao rolar a página
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});
</script>
