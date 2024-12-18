<?php
$rootPrivate = 'SecretPath';

# Verificação do Protocolo HTTPS
include_once '../'.$rootPrivate.'/middlewares/redirect_to_https.php';

# Segurança do header
include_once '../'.$rootPrivate.'/middlewares/security_headers.php';

# Configuração exibição de erros para debug
include_once '../'.$rootPrivate.'/middlewares/debug_config.php';

# Configuração de sessão e proteção dos cookies
include_once '../'.$rootPrivate.'/middlewares/session_config.php';

# Configuração de sessão e proteção dos cookies
include_once '../'.$rootPrivate.'/middlewares/dynamic_content.php';
?>