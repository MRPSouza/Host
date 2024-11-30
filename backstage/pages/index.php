<?php
/**
 * LEMBRETES IMPORTANTES:
 * 
 * 1. ESTRUTURA BASE HTML:
 * - html.head.body.php e html.script.body.php são carregados automaticamente em todas as páginas
 * - Não é necessário criar tags <html>, <head>, <body> ou incluir scripts nas páginas individuais
 * - CSS e JS complementares devem ser adicionados separadamente em arquivos .css e .js
 * 
 * 2. COMPONENTES BOOTSTRAP DISPONÍVEIS:
 * - Bootstrap 5.3.0 (CSS e JS)
 * - Bootstrap Icons
 * - Bootstrap Popover-X
 * - Bootstrap Tooltip-X
 * - Bootstrap Toastify
 * - Bootstrap Select
 * - Bootstrap Table
 * - Bootstrap Toggle
 * - Bootstrap TouchSpin
 * - Bootstrap TagsInput
 * - Bootstrap DateRangePicker
 * - Bootstrap DateTimePicker
 * - Bootstrap ColorPicker
 * - Bootstrap MaxLength
 * - Bootstrap Input Spinner
 * 
 * Todos os componentes acima já estão configurados e prontos para uso.
 */

// Ativa exibição de erros para debug em desenvolvimento
?>

Início da página

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