// document.addEventListener('DOMContentLoaded', function() {
//     // Função para carregar conteúdo via AJAX
//     function loadContent(href) {
//         toggleLoader(true);
        
//         fetch(href, {
//             method: 'GET',
//             headers: {
//                 'X-Requested-With': 'XMLHttpRequest',
//                 'Accept': 'text/html'
//             }
//         })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error(`HTTP error! status: ${response.status}`);
//             }
//             return response.text();
//         })
//         .then(html => {
//             const parser = new DOMParser();
//             const doc = parser.parseFromString(html, 'text/html');
//             const mainContent = doc.querySelector('main');
            
//             if (mainContent) {
//                 document.querySelector('main').innerHTML = mainContent.innerHTML;
//                 window.history.pushState({}, '', href);
//             } else {
//                 throw new Error('Elemento main não encontrado na resposta');
//             }

//             const seoData = doc.querySelector('seo-data');
//             if (seoData) {
//                 const head = document.querySelector('head');
//                 // Remove as meta tags antigas de SEO
//                 head.querySelectorAll('meta[name="description"], meta[name="keywords"], title, meta[property^="og:"]').forEach(el => el.remove());
                
//                 // Adiciona apenas as novas meta tags de SEO
//                 const seoContent = seoData.innerHTML;
//                 head.insertAdjacentHTML('afterbegin', seoContent);
//             }
//         })
//         .catch(error => {
//             console.error('Erro ao carregar página:', error);
//         })
//         .finally(() => {
//             toggleLoader(false);
//         });
//     }

//     // Intercepta todos os cliques em links do menu
//     document.querySelectorAll('nav a').forEach(link => {
//         link.addEventListener('click', function(e) {
//             e.preventDefault();
//             const href = this.getAttribute('href');
//             loadContent(href);
//         });
//     });

//     // Gerencia o botão voltar do navegador
//     window.addEventListener('popstate', function(e) {
//         loadContent(window.location.href);
//     });
// });