<?php
function handleError($e) {
    error_log("Erro crítico: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
}
