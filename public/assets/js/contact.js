document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nome = document.getElementById('nome').value.trim();
            const sobrenome = document.getElementById('sobrenome').value.trim();
            const mensagem = document.getElementById('mensagem').value.trim();
            
            // Pega o número do WhatsApp do atributo data
            const numeroWhatsApp = form.dataset.whatsapp;
            
            if (!nome || !sobrenome || !mensagem) {
                alert('Por favor, preencha todos os campos.');
                return;
            }
            
            // Monta a mensagem formatada
            const mensagemFormatada = `Olá! Me chamo ${nome} ${sobrenome}.\n\n${mensagem}`;
            
            // Cria o link do WhatsApp
            const linkWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensagemFormatada)}`;
            
            // Abre o WhatsApp
            window.open(linkWhatsApp, '_blank');
        });
    }
});