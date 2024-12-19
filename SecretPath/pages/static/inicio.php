<?php
// Exibir os módulos Apache carregados
echo "<h4><strong>Módulos Apache carregados:<br></strong></h4>";
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    foreach ($modules as $module) {
        echo $module . "<br>";
    }
}

// Exibir todas as variáveis do servidor
echo "<h4><strong><br>Todas as variáveis do servidor:<br></strong></h4>";
foreach ($_SERVER as $key => $value) {
    // Substituir ";" por ";<br>" se o valor for uma lista de caminhos
    if (strpos($value, ';') !== false) {
        $value = str_replace(';', ';<br>', $value);
    }
    echo "$key => $value<br>";
}

// Exibir a versão do PHP
echo "<br>Versão do PHP: " . PHP_VERSION;
?>
