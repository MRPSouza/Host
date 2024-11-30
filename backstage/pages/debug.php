<?php
// Informações do servidor
echo "Módulos Apache carregados: <br>";
if (function_exists('apache_get_modules')) {
    print_r(apache_get_modules());
}

echo "<br><br>Todas as variáveis do servidor: <br>";
foreach($_SERVER as $key => $value) {
    echo "$key => $value <br>";
}

// Versão do PHP também pode ajudar
echo "<br>Versão do PHP: " . PHP_VERSION;
?>