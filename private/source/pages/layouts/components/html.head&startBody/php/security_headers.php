<?php
$csp = "default-src 'self'; " .
    "script-src 'self' " . 
    "'sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r' " .
    "'sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz' " .
    "'nonce-" . $nonces['content_dynamic'] . "' " .
    "'nonce-" . $nonces['resize_body'] . "' " .
    "'nonce-" . $nonces['iframe_restrict'] . "' " .
    "'nonce-" . $nonces['tooltip'] . "'; " .
    "style-src 'self' " .
    "'sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' " .
    "'sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=='; " .
    "font-src 'self' https://cdnjs.cloudflare.com data:; " .
    "img-src 'self' data:;";

header("Content-Security-Policy: " . $csp);
?>
