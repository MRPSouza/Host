<?php
$csp = "script-src 'self' " .
    "'nonce-{$script_nonce_1}' " .
    "'nonce-{$script_nonce_2}' " .
    "'nonce-{$script_nonce_3}' " .
    "'nonce-{$script_nonce_4}'";

header("Content-Security-Policy: " . $csp);
?>
