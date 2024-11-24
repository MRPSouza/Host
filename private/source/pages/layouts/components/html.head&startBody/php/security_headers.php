<?php
$csp = "default-src 'self'; " .
    "script-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com " . 
    "'nonce-" . $nonces['content_dynamic'] . "' " .
    "'nonce-" . $nonces['resize_body'] . "' " .
    "'nonce-" . $nonces['iframe_restrict'] . "' " .
    "'nonce-" . $nonces['tooltip'] . "' " .
    "'nonce-" . $nonces['bootstrap_js'] . "' " .
    "'nonce-" . $nonces['popper_js'] . "'; " .
    "style-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com " .
    "'nonce-" . $nonces['bootstrap_css'] . "' " .
    "'nonce-" . $nonces['fontawesome'] . "'; " .
    "font-src 'self' https://cdnjs.cloudflare.com data:; " .
    "img-src 'self' data:;";

header("Content-Security-Policy: " . $csp);
?>
