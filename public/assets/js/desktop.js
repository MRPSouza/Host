document.addEventListener('DOMContentLoaded', function() {
    const desktop = document.getElementById('desktop');
    const icons = document.querySelectorAll('.desktop-icon');
    const taskbarTime = document.getElementById('taskbar-time');

    // Atualizar relógio
    function updateClock() {
        const now = new Date();
        taskbarTime.textContent = now.toLocaleTimeString();
    }
    updateClock();
    setInterval(updateClock, 1000);

    // Funcionalidade de arrastar e soltar
    icons.forEach(icon => {
        icon.addEventListener('dragstart', function(e) {
            e.dataTransfer.setData('text/plain', '');
            this.classList.add('dragging');
        });

        icon.addEventListener('dragend', function() {
            this.classList.remove('dragging');
        });

        // Clique duplo para navegação
        icon.addEventListener('dblclick', function() {
            const path = this.dataset.path;
            if (path) {
                if (path.startsWith('http')) {
                    window.open(path, '_blank');
                } else {
                    window.location.href = path;
                }
            }
        });

        // Seleção de ícone
        icon.addEventListener('click', function(e) {
            icons.forEach(i => i.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Permitir soltar ícones na área de trabalho
    desktop.addEventListener('dragover', function(e) {
        e.preventDefault();
    });

    desktop.addEventListener('drop', function(e) {
        e.preventDefault();
        const icon = document.querySelector('.dragging');
        if (icon) {
            const rect = desktop.getBoundingClientRect();
            const x = e.clientX - rect.left - (icon.offsetWidth / 2);
            const y = e.clientY - rect.top - (icon.offsetHeight / 2);
            
            // Mantém o ícone dentro dos limites da área de trabalho
            const maxX = rect.width - icon.offsetWidth;
            const maxY = rect.height - icon.offsetHeight;
            
            icon.style.position = 'absolute';
            icon.style.left = `${Math.max(0, Math.min(x, maxX))}px`;
            icon.style.top = `${Math.max(0, Math.min(y, maxY))}px`;
        }
    });

    // Remover seleção ao clicar na área de trabalho
    desktop.addEventListener('click', function(e) {
        if (e.target === desktop) {
            icons.forEach(icon => icon.classList.remove('selected'));
        }
    });
});