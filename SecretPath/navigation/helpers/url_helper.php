<?php
function processUrl($fullUrl) {
    $baseDir = parse_url(BASE_URL, PHP_URL_PATH) ?? '';
    $url = trim(str_replace($baseDir, '', $fullUrl), '/');
    return filter_var(rtrim(parse_url($url, PHP_URL_PATH) ?? '', '/'), FILTER_SANITIZE_URL);
}
