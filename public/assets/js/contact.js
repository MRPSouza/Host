document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const nome = document.getElementById('nome').value;
    const sobrenome = document.getElementById('sobrenome').value;
    const mensagem = document.getElementById('mensagem').value;
    
    // Número do WhatsApp da loja (substitua pelo número correto)
    const numeroWhatsApp = '5511999999999';
    
    // Monta a mensagem formatada
    const mensagemFormatada = `Olá! Me chamo ${nome} ${sobrenome}.\n\n${mensagem}`;
    
    // Cria o link do WhatsApp
    const linkWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensagemFormatada)}`;
    
    // Abre o WhatsApp
    window.open(linkWhatsApp, '_blank');
});