<?php
// Remover headers anteriores
header_remove("Content-Security-Policy");
header_remove("Content-Security-Policy-Report-Only");

// Todas as hashes para scripts inline
$script_hashes = [
    'sha256-jNUaLyKtUOtTVaAUziqIV9DJCNPr3ty5ZK4o7WIe1TU=',
    'sha256-nIM4BcNJOC4LkaaAAZi8OIyVCMQckbzj+xSGRQXwflY=',
    'sha256-51S9ThZdsSdNFIWpaX5ppEm6nt4j+XHVvU1xW/LH9ng=',
    'sha256-k2UHtayxw6rd21AKKJSQ2u7g+C9wCNMJIaWnfSFZ5Jk=',
    'sha256-5G9EkZVw7e4y1kGjf2UGMPpBSj6zhFYn8xY127Ik0ZY=',
    'sha256-NFmvEJVcHjAZn/53ZMpRPLqOXAzQLT3+9FCNIOcPNG0=',
    'sha256-UwKR6eUgxJtLp5mCYmFeZzoLxJnpe4TJf45F2UjHHzg=',
    'sha256-cYqnrUYyQlkwgP3RtYwSoESjajoJ8ED/9pxPNiR7A5I=',
    'sha256-yNkWmSfORy6YeljrSbrNoQf9dfYGQIKqIbg67fXggO0=',
    'sha256-L7LVnmJr2aJMnM4/QVWknVWULQTUlXyFUqIyOf0Xsew=',
    'sha256-r3pjISWNgs7KC6pPQauTQMCvZlJsnQHv7PYURUa28/s=',
    'sha256-Gq0FhTSKdZSEleBC+hLQri648xC8ghK+E695pBug4XI=',
    'sha256-mWyJmBu+UE1ITy5GR5OLLmdIfGdx7bF4FL2ii86f7Ak=',
    'sha256-mkiWDNshlx3TP8EQ7uodBADmHv9w7JZ/574ahpDzjiQ=',
    'sha256-wShYhjL/WEbqxgBgWQPvW6VSsr1gGYvGj9ZPDNsVK3w=',
    'sha256-k9ISLWHcPDNxxmLk/z1Kmn5JcTnyxlLgbQgQkI+zmjg=',
    'sha256-OPlvV0PukpmbD8NgO7FYL0fXmC6HWYqI5Z4/GoE+D4w=',
    'sha256-d6MhXPGKHgj5QgE+0nM7Ra+5XEQN570BMDXwhH627WM=',
    'sha256-ktsoVgZzBrCc7uWJHbouqdvgwtNoNKxhKFR9j81Ni0E=',
    'sha256-gUt3x4oAYKg4ROSECT8OWrXYpMRZsKZAg6rtLgTM4wE=',
    'sha256-o+ChJmE+JVyXAsOt12Q7OHrs5Kc8TG/xTH/iNfirUlI='
];

// Todas as hashes para estilos inline
$style_hashes = [
    'sha256-lSQTU/F1/ZmmX3RPh56utZLWWyMEu9Uch9bC475QvPA=',
    'sha256-muFRSnplr5N3iEjTOjXk+DFAY53hts6pBpEoEDnY4W0=',
    'sha256-0qxSfKRkLT0a0s7bdPKt0OzTgaGpWK4YjJngQBs766A=',
    'sha256-SYJUZ32nvWNLb7A/RnSwtdSuCB+zBLAtWdp1JBTfO9w=',
    'sha256-rlx+YSsXcrPIXjRJ3Khg65SeaMFQI/6MyJvLVGaWSaA=',
    'sha256-eoYVeC34m1+4tLjM76MjpaPlMCFnZl6oAJ+wf8124Tk=',
    'sha256-iZkb53UPZKGjsK/QWVA4U2P7yf+8joKG6vfOAdY8pFk='
];

// Converter arrays de hashes para string
$script_hashes_str = implode("' '", $script_hashes);
$style_hashes_str = implode("' '", $style_hashes);

// Construir a política CSP
$csp = "default-src 'self'; " .
    "script-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com " . 
       implode(" ", array_map(function($hash) { return "'$hash'"; }, $script_hashes)) . "; " .
    "style-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com '" . $style_hashes_str . "'; " .
    "font-src 'self' https://cdnjs.cloudflare.com data:; " .
    "img-src 'self' data:; " .
    "media-src 'self' data: https://* http://*; " .
    "connect-src 'self' *; " .
    "frame-ancestors 'self'; " .
    "form-action 'self'; " .
    "base-uri 'self'; " .
    "object-src 'self'";

header("Content-Security-Policy: $csp");
?>
