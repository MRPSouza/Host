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
// Método 1: apache_get_version()
if (function_exists('apache_get_version')) {
    echo "Versão do Apache (método 1): " . apache_get_version() . "<br>";
}

// Método 2: $_SERVER['SERVER_SOFTWARE']
echo "Versão do Apache (método 2): " . $_SERVER['SERVER_SOFTWARE'] . "<br>";

// Método 3: phpinfo()
// phpinfo(INFO_MODULES); // Mostra informações detalhadas, incluindo módulos Apache
?>