<?php
/**
 * LEMBRETES IMPORTANTES:
 * 
 * Framework CSS/JS:
 * - Bootstrap 5.3.3 (CSS e JS)
 *   • Popover
 *   • Tooltip
 *   • Modal
 *   • Dropdown
 *   • E outros componentes do Bootstrap
 * - Font Awesome 6.5.1
 * - Bootstrap Icons 1.11.3
 * 
 * Bibliotecas JavaScript:
 * - jQuery 3.7.1
 * 
 * Todos os componentes estão configurados com:
 * - Fallback automático para CDN alternativo
 * - Fallback para arquivos locais em /assets/vendor/
 * - Carregamento otimizado (crítico vs não-crítico)
 * - Política de segurança CSP configurada
 * 
 * OBSERVAÇÃO:
 * - Não é necessário incluir tags <html>, <head>, <body> ou scripts
 * - Arquivos html.head.body.php e html.script.body.php são carregados automaticamente
 * - CSS e JS adicionais devem ser incluídos em arquivos separados
 */

?>
<?php
$companyName = "Mister Cel";
$since = "2008";
$developer = "MT Mente & Máquina";
$slogan = "Solução Digital Potencializada por IA";
$currentYear = date('Y');
?>

<footer class="footer text-center">
    <div class="container">
        <p class="mb-0">
           <small>Desenvolvido por <?php echo $developer; ?> | <?php echo $slogan; ?></small>
        </p>
    </div>
</footer>
