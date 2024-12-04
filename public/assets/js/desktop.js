document.addEventListener('DOMContentLoaded', function() {
    const desktop = document.getElementById('desktop');
    const icons = document.querySelectorAll('.desktop-icon');
    const taskbarTime = document.getElementById('taskbar-time');
    const contextMenu = document.createElement('div');
    contextMenu.className = 'context-menu';
    document.body.appendChild(contextMenu);

    // Atualizar relógio
    function updateClock() {
        if (taskbarTime) {
            const now = new Date();
            taskbarTime.textContent = now.toLocaleTimeString();
        }
    }

    // Só inicia o relógio se o elemento existir
    if (taskbarTime) {
        updateClock();
        setInterval(updateClock, 1000);
    }

    // Carregar organização dos ícones
    function loadIconPositions() {
        const positions = JSON.parse(localStorage.getItem('iconPositions') || '{}');
        icons.forEach(icon => {
            const id = icon.dataset.path;
            if (positions[id]) {
                icon.style.position = 'absolute';
                icon.style.left = positions[id].left;
                icon.style.top = positions[id].top;
            }
        });
    }

    // Salvar organização dos ícones
    function saveIconPositions() {
        const positions = {};
        icons.forEach(icon => {
            const id = icon.dataset.path;
            positions[id] = {
                left: icon.style.left,
                top: icon.style.top
            };
        });
        localStorage.setItem('iconPositions', JSON.stringify(positions));
    }

    // Funcionalidade de arrastar e soltar
    icons.forEach(icon => {
        icon.addEventListener('dragstart', function(e) {
            e.dataTransfer.setData('text/plain', '');
            this.classList.add('dragging');
        });

        icon.addEventListener('dragend', function() {
            this.classList.remove('dragging');
            saveIconPositions();
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
            saveIconPositions();
        }
    });

    // Remover seleção ao clicar na área de trabalho
    desktop.addEventListener('click', function(e) {
        if (e.target === desktop) {
            icons.forEach(icon => icon.classList.remove('selected'));
        }
    });

    // Menu de contexto
    desktop.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        contextMenu.style.top = `${e.clientY}px`;
        contextMenu.style.left = `${e.clientX}px`;
        contextMenu.style.display = 'block';
    });

    document.addEventListener('click', function() {
        contextMenu.style.display = 'none';
    });

    // Adicionar opções ao menu de contexto
    contextMenu.innerHTML = `
        <div class="context-menu-item" id="add-icon">Adicionar Ícone</div>
        <div class="context-menu-item" id="change-background">Mudar Fundo</div>
    `;

    // Adicionar novo ícone
    document.getElementById('add-icon').addEventListener('click', function() {
        const name = prompt('Nome do ícone:');
        const path = prompt('Caminho do ícone:');
        if (name && path) {
            const newIcon = document.createElement('div');
            newIcon.className = 'desktop-icon';
            newIcon.draggable = true;
            newIcon.dataset.path = path;
            newIcon.innerHTML = `<i class="bi bi-file-earmark"></i><span>${name}</span>`;
            desktop.appendChild(newIcon);
            icons.push(newIcon);
            saveIconPositions();
        }
    });

    // Mudar imagem de fundo
    document.getElementById('change-background').addEventListener('click', function() {
        const url = prompt('URL da imagem de fundo:');
        if (url) {
            desktop.style.backgroundImage = `url(${url})`;
            localStorage.setItem('backgroundImage', url);
        }
    });

    // Carregar imagem de fundo
    const savedBackground = localStorage.getItem('backgroundImage');
    const defaultBackground = '/assets/img/default-background.jpg'; // Caminho para a imagem padrão
    desktop.style.backgroundImage = `url(${savedBackground || defaultBackground})`;

    loadIconPositions();
});