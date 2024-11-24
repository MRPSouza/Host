<?php
  /* Dicas SEO
        O título e a meta descrição SEO não podem ficar em branco;
        O título e a metadescrição SEO devem incluir a palavra-chave principal;
        O título SEO deve ter entre 10 e 60 caracteres. 
        Use apenas um título H1 em cada página
        Descrição com no máximo 160 caracteres
        Título, descrição e o H1 devem ser únicos em cada página.
    */

    $current_page = basename($_SERVER['PHP_SELF'], '.php'); // Não mexer !!

    $pages_config = [
        'index'                         => [
            'extension'                 => '.php',
            'titulo_da_aba'             => 'Página Inicial'.$nome_site,
            'meta_titulo'               => '', // Até 40 caracteres!
            'meta_descricao'            => '', // Descrição recomendada para SEO
            'link_canonico'             => '',
            'meta_palavras_chaves'      => '',
            'imagem_da_pagina_atual'    => '',
            'robots'                    => 'follow, index',
            'googlebot'                 => 'index,follow',
            'googlebot_news'            => 'noindex'
        ],
        '404'                           => [
            'extension'                 => '.php',
            'titulo_da_aba'             => 'Página não encontrada'.$nome_site,
            'meta_titulo'               => '', // Até 40 caracteres!
            'meta_descricao'            => '',
            'link_canonico'             => '',
            'meta_palavras_chaves'      => '',
            'imagem_da_pagina_atual'    => '',
            'robots'                    => 'nofollow, noindex',
            'googlebot'                 => 'noindex,nofollow',
            'googlebot_news'            => 'noindex'
        ],
        '500'                           => [
            'extension'                 => '.php',
            'titulo_da_aba'             => ''.$nome_site,
            'meta_titulo'               => '', // Até 40 caracteres!
            'meta_descricao'            => '',
            'link_canonico'             => '',
            'meta_palavras_chaves'      => '',
            'imagem_da_pagina_atual'    => '',
            'robots'                    => 'nofollow, noindex',
            'googlebot'                 => 'noindex,nofollow',
            'googlebot_news'            => 'noindex'
        ],
        'terms'                         => [
            'extension'                 => '.php',
            'titulo_da_aba'             => 'Termos'.$nome_site,
            'meta_titulo'               => '', // Até 40 caracteres!
            'meta_descricao'            => '',
            'link_canonico'             => '',
            'meta_palavras_chaves'      => '',
            'imagem_da_pagina_atual'    => '',
            'robots'                    => 'nofollow, noindex',
            'googlebot'                 => 'noindex,nofollow',
            'googlebot_news'            => 'noindex'
        ],
        'privacy'                       => [
            'extension'                 => '.php',
            'titulo_da_aba'             => 'Privacidade'.$nome_site,
            'meta_titulo'               => '', // Até 40 caracteres!
            'meta_descricao'            => '',
            'link_canonico'             => '',
            'meta_palavras_chaves'      => '',
            'imagem_da_pagina_atual'    => '',
            'robots'                    => 'nofollow, noindex',
            'googlebot'                 => 'noindex,nofollow',
            'googlebot_news'            => 'noindex'
        ],
        'cookies'                       => [
            'extension'                 => '.php',
            'titulo_da_aba'             => 'Privacidade'.$nome_site,
            'meta_titulo'               => '', // Até 40 caracteres!
            'meta_descricao'            => '',
            'link_canonico'             => '',
            'meta_palavras_chaves'      => '',
            'imagem_da_pagina_atual'    => '',
            'robots'                    => 'nofollow, noindex',
            'googlebot'                 => 'noindex,nofollow',
            'googlebot_news'            => 'noindex'
        ],
        'cad.usuario'                   => [
            'extension'                 => '.php',
            'titulo_da_aba'             => ''.$nome_site,
            'meta_titulo'               => '', // Até 40 caracteres!
            'meta_descricao'            => '',
            'link_canonico'             => '',
            'meta_palavras_chaves'      => '',
            'imagem_da_pagina_atual'    => '',
            'robots'                    => 'nofollow, noindex',
            'googlebot'                 => 'noindex,nofollow',
            'googlebot_news'            => 'noindex'
        ]
    ];

    // Definição de Variáveis Dinâmicas com base na página atual
    if (array_key_exists($current_page, $pages_config)) {
        $titulo_da_aba                  = $pages_config[$current_page]['titulo_da_aba'];
        $meta_titulo_da_pagina          = $pages_config[$current_page]['meta_titulo'];
        $meta_descricao                 = $pages_config[$current_page]['meta_descricao'];
        $link_canonico_da_pagina_atual  = $pages_config[$current_page]['link_canonico'];
        $meta_palavras_chaves           = $pages_config[$current_page]['meta_palavras_chaves'];
        $current_css                    = $current_page.'.css';
        $imagem_da_pagina_atual         = $pages_config[$current_page]['imagem_da_pagina_atual'];
        $robots                         = $pages_config[$current_page]['robots'];
        $googlebot                      = $pages_config[$current_page]['googlebot'];
        $googlebot_news                 = $pages_config[$current_page]['googlebot_news'];

    } else {
        $titulo_da_aba                  = 'Página Desconhecida';
        $meta_titulo_da_pagina          = 'Página Não Encontrada';
        $meta_descricao                 = '';
        $link_canonico_da_pagina_atual  = '';
        $meta_palavras_chaves           = '';
        $current_css                    = '';
        $page_current                   = $current_page;
        $imagem_da_pagina_atual         = '';
        $robots                         = 'nofollow, noindex';
        $googlebot                      = 'noindex,nofollow';
        $googlebot_news                 = 'noindex';
    }