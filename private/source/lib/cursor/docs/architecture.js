/**
 * Arquitetura do Projeto
 * ---------------------
 * 
 * Estrutura Principal:
 * C:/xampp/htdocs/ProjetoModelo
 *   /Host
 *     /private
 *       /source
 *         /lib
 *         /model
 *         /pages
 *           /config
 *           /layout
 *             /components
 *           /templates
 *         /resources [LOCALIZAÇÃO ATUAL]
 *           /system_account
 *             /database
 *               db_account.sql
 *           /system_blog
 *           /system_chat
 *           /system_payment
 *     /public
 *   /Docs
 *   /Design
 *   /Source
 * 
 * Características:
 * - Separação clara entre código público e privado
 * - Sistema de componentes reutilizáveis
 * - Gestão de SEO via JSON (/pages/data/seo_pages.json)
 * - Headers de segurança implementados
 * - Sistema de fallback para CDNs (/vendor)
 * 
 * Fluxo das Páginas:
 * 1. Entrada via public
 * 2. Definição dinâmica da página atual
 * 3. Verificação de visibilidade
 * 4. Carregamento de headers de segurança
 * 5. Montagem da estrutura HTML
 * 6. Injeção de conteúdo dinâmico
 * 
 *
 * [ESTRUTURA DINÂMICA DO CURSOR]
 * /cursor/ (pasta móvel de documentação)
 *   /docs/
 *     ai_response_format.js - Formatação
 *     api.js           - Documentação de APIs
 *     architecture.js   - Estrutura do projeto
 *     database.js      - Estrutura do banco
 *     environment.js   - Configurações
 *     instructions.js  - Ponto de entrada
 *     requirements.js  - Dependências
 * 
 *   /memory/
 *     context.js       - Contexto atual
 *     conversations.js - Histórico de conversas
 *     history.js       - Histórico de decisões
 *     learning.js      - Aprendizados
 *     roadmap.js       - Planejamento
 *     self_check.js    - Sistema de verificação
 *     user.js          - Perfil do usuário
 * 
 *   /debug/
 *     current.js       - Estado atual
 *     notes.js         - Notas importantes
 * 
 * Observações sobre o Cursor:
 * ! Pasta móvel que acompanha o desenvolvimento
 * ! Usado APENAS para documentação e memória
 * ! Não faz parte da estrutura do projeto
 * ! Mantém contexto entre conversas
 * ! Auto-organizável e adaptável
 * 
 * 
 * Sistema de Auto-Verificação:
 * 1. Checklist para cada interação
 * 2. Verificação de formato de resposta
 * 3. Atualização de arquivos críticos
 * 4. Verificações de localização
 * 5. Comandos especiais (@cursor)
 * 
 * Arquivos de Atualização Frequente:
 * - context.js    (a cada conversa)
 * - history.js    (a cada decisão)
 * - roadmap.js    (a cada milestone)
 * 
 * Última Atualização: ${new Date().toISOString()}
 */
