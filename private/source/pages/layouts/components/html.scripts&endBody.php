<?php
// Scripts locais
require_once('html.scripts&endBody/js/content_dynamic.js');
require_once('html.scripts&endBody/js/resize_body_bootstrap.js');
require_once('html.scripts&endBody/js/restriction_against_iframe.js');
require_once('html.scripts&endBody/js/tooltip_popover.js');

// Scripts externos com integrity
foreach ($external_scripts as $key => $script) {
    echo "<script src='{$script['src']}' 
                 integrity='{$script['integrity']}' 
                 crossorigin='{$script['crossorigin']}'></script>";
}
?>

